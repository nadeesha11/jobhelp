<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mainFilterController extends Controller
{
    // *** for develop electronics category functions 
    protected function electronics($id)
    {

        $cat_id = 2;
        // Forget a specific session variable
        session()->forget('electronics_filter_data');

        $ads = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 2)
            ->where('ads.sub_cat_id', $id)
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        return view('web.displayAdsFilters.electronics', compact('ads', 'id', 'cat_id'));
    }

    public function electronicsFilterdRedirect(Request $request)
    {
        $oldFilterData = session('electronics_filter_data', []); // get old session data
        session([
            'electronics_filter_data' => [
                'min' => $request->min ??  null,
                'max' => $request->max ??  null,
                'subCat' => $request->subCat ?? ($oldFilterData['subCat'] ?? null),
                'new' => $request->new ?? null, // dont need old data
                'used' => $request->used ?? null, // dont need old data

                "Ampara"  => $request->Ampara ?? null,
                "Anuradhapura" => $request->Anuradhapura ?? null,
                "Badulla" => $request->Badulla ?? null,
                "Batticaloa" => $request->Batticaloa ?? null,
                "Colombo" => $request->Colombo ?? null,
                "Galle" => $request->Galle ?? null,
                "Gampaha" => $request->Gampaha ?? null,
                "Hambantota" => $request->Hambantota ?? null,
                "Jaffna" => $request->Jaffna ?? null,
                "Kalutara" => $request->Kalutara ?? null,
                "Kandy" => $request->Kandy ?? null,
                "Kegalle" => $request->Kegalle ?? null,
                "Kilinochchi" => $request->Kilinochchi ?? null,
                "Kurunegala" => $request->Kurunegala ?? null,
                "Mannar" => $request->Mannar ?? null,
                "Matale" => $request->Matale ?? null,
                "Matara" => $request->Matara ?? null,
                "Monaragala" => $request->Monaragala ?? null,
                "Mullaitivu" => $request->Mullaitivu ?? null,
                "Nuwara_Eliya" => $request->Nuwara_Eliya ?? null,
                "Polonnaruwa" => $request->Polonnaruwa ?? null,
                "Puttalam" => $request->Puttalam ?? null,
                "Ratnapura" => $request->Ratnapura ?? null,
                "Trincomalee" => $request->Trincomalee ?? null,
                "Vavuniya" => $request->Vavuniya ?? null,

            ]
        ]);
        return redirect()->route('electronics.filterd.ads');
    }

    public function electronicsFilterdDisplay(Request $request)
    {
        $cat_id = 2;
        $electronicsFilterData = session('electronics_filter_data', []);

        //store values in array
        $conditionValues = []; // store electronics in a array
        if (isset($electronicsFilterData['new'])) {
            $conditionValues[] = $electronicsFilterData['new'];
        }
        if (isset($electronicsFilterData['used'])) {
            $conditionValues[] = $electronicsFilterData['used'];
        }

        //store values in array
        $locationValues = []; // store location in a array

        if (isset($electronicsFilterData['Ampara'])) {
            $locationValues[] = $electronicsFilterData['Ampara'];
        }
        if (isset($electronicsFilterData['Anuradhapura'])) {
            $locationValues[] = $electronicsFilterData['Anuradhapura'];
        }
        if (isset($electronicsFilterData['Badulla'])) {
            $locationValues[] = $electronicsFilterData['Badulla'];
        }
        if (isset($electronicsFilterData['Batticaloa'])) {
            $locationValues[] = $electronicsFilterData['Batticaloa'];
        }
        if (isset($electronicsFilterData['Colombo'])) {
            $locationValues[] = $electronicsFilterData['Colombo'];
        }
        if (isset($electronicsFilterData['Galle'])) {
            $locationValues[] = $electronicsFilterData['Galle'];
        }
        if (isset($electronicsFilterData['Gampaha'])) {
            $locationValues[] = $electronicsFilterData['Gampaha'];
        }
        if (isset($electronicsFilterData['Hambantota'])) {
            $locationValues[] = $electronicsFilterData['Hambantota'];
        }
        if (isset($electronicsFilterData['Jaffna'])) {
            $locationValues[] = $electronicsFilterData['Jaffna'];
        }
        if (isset($electronicsFilterData['Kalutara'])) {
            $locationValues[] = $electronicsFilterData['Kalutara'];
        }
        if (isset($electronicsFilterData['Kandy'])) {
            $locationValues[] = $electronicsFilterData['Kandy'];
        }
        if (isset($electronicsFilterData['Kegalle'])) {
            $locationValues[] = $electronicsFilterData['Kegalle'];
        }
        if (isset($electronicsFilterData['Kilinochchi'])) {
            $locationValues[] = $electronicsFilterData['Kilinochchi'];
        }
        if (isset($electronicsFilterData['Kurunegala'])) {
            $locationValues[] = $electronicsFilterData['Kurunegala'];
        }
        if (isset($electronicsFilterData['Mannar'])) {
            $locationValues[] = $electronicsFilterData['Mannar'];
        }
        if (isset($electronicsFilterData['Matale'])) {
            $locationValues[] = $electronicsFilterData['Matale'];
        }
        if (isset($electronicsFilterData['Matara'])) {
            $locationValues[] = $electronicsFilterData['Matara'];
        }
        if (isset($electronicsFilterData['Monaragala'])) {
            $locationValues[] = $electronicsFilterData['Monaragala'];
        }
        if (isset($electronicsFilterData['Mullaitivu'])) {
            $locationValues[] = $electronicsFilterData['Mullaitivu'];
        }
        if (isset($electronicsFilterData['Nuwara_Eliya'])) {
            $locationValues[] = $electronicsFilterData['Nuwara_Eliya'];
        }
        if (isset($electronicsFilterData['Polonnaruwa'])) {
            $locationValues[] = $electronicsFilterData['Polonnaruwa'];
        }
        if (isset($electronicsFilterData['Puttalam'])) {
            $locationValues[] = $electronicsFilterData['Puttalam'];
        }
        if (isset($electronicsFilterData['Ratnapura'])) {
            $locationValues[] = $electronicsFilterData['Ratnapura'];
        }
        if (isset($electronicsFilterData['Trincomalee'])) {
            $locationValues[] = $electronicsFilterData['Trincomalee'];
        }
        if (isset($electronicsFilterData['Vavuniya'])) {
            $locationValues[] = $electronicsFilterData['Vavuniya'];
        }

        $adsQuery = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 2);

        if (isset($electronicsFilterData['subCat'])) {
            $adsQuery->where('ads.sub_cat_id', $electronicsFilterData['subCat']);
        }
        if (isset($electronicsFilterData['min'])) {
            $adsQuery->where('ads.ads_price', '>=', $electronicsFilterData['min']);
        }
        if (isset($electronicsFilterData['max'])) {
            $adsQuery->where('ads.ads_price', '<=', $electronicsFilterData['max']);
        }
        if (!empty($conditionValues)) {
            $adsQuery->whereIn('electronics.ele_condition', $conditionValues);
        }
        if (!empty($locationValues)) {
            $adsQuery->whereIn('ads.ads_location', $locationValues);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('electronics', 'ads.id', '=', 'electronics.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        $id = $electronicsFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.electronics', compact('ads', 'id', 'cat_id'));
    }
    // *** for develop electronics category functions ^^^^

    // *** for develop vehicles category functions 
    protected function vehicles($id)
    {
        $cat_id = 3;
        // Forget a specific session variable
        session()->forget('vehicle_filter_data');

        $ads = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 3)
            ->where('ads.sub_cat_id', $id)
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        return view('web.displayAdsFilters.vehicles', compact('ads', 'id', 'cat_id'));
    }

    public function vehiclesFilterdRedirect(Request $request)
    {

        $oldFilterDataVehicle = session('vehicle_filter_data', []); // get old session data
        session([
            'vehicle_filter_data' => [
                'min' => $request->min ?? null,
                'max' => $request->max ?? null,
                'subCat' => $request->subCat,
            ]
        ]);

        return redirect()->route('vehicles.filterd.ads');
    }

    public function vehiclesFilterdDisplay(Request $request)
    {
        $cat_id = 3;
        $vehiclesFilterData = session('vehicle_filter_data', []);

        $adsQuery = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 3);

        if (isset($vehiclesFilterData['subCat'])) {
            $adsQuery->where('ads.sub_cat_id', $vehiclesFilterData['subCat']);
        }

        if (isset($vehiclesFilterData['min'])) {
            $adsQuery->where('ads.ads_price', '>=', $vehiclesFilterData['min']);
        }

        if (isset($vehiclesFilterData['max'])) {
            $adsQuery->where('ads.ads_price', '<=', $vehiclesFilterData['max']);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('vehicle', 'ads.id', '=', 'vehicle.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        $id = $vehiclesFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.vehicles', compact('ads', 'id', 'cat_id'));
    }

    // *** for develop vehicles category functions ^^^^

    // *** for develop property category function  ^^^^
    public function property($id)
    {
        $cat_id = 4;
        // Forget a specific session variable
        session()->forget('property_filter_data');

        $ads = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 4)
            ->where('ads.sub_cat_id', $id)
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        return view('web.displayAdsFilters.property', compact('ads', 'id', 'cat_id'));
    }

    public function propertyFilterdRedirect(Request $request)
    {
        $oldFilterDataProperty = session('property_filter_data', []); // get old session data
        session([
            'property_filter_data' => [
                'min' => $request->min ?? null,
                'max' => $request->max ?? null,
                'subCat' => $request->subCat,
            ]
        ]);

        return redirect()->route('property.filterd.ads');
    }

    public function propertyFilterdDisplay()
    {
        $cat_id = 4;
        $propertyFilterData = session('property_filter_data', []);

        $adsQuery = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 4);

        if (isset($propertyFilterData['subCat'])) {
            $adsQuery->where('ads.sub_cat_id', $propertyFilterData['subCat']);
        }

        if (isset($propertyFilterData['min'])) {
            $adsQuery->where('ads.ads_price', '>=', $propertyFilterData['min']);
        }

        if (isset($propertyFilterData['max'])) {
            $adsQuery->where('ads.ads_price', '<=', $propertyFilterData['max']);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('property', 'ads.id', '=', 'property.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        $id = $propertyFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.property', compact('ads', 'id', 'cat_id'));
    }

    // *** for develop property category function  ^^^^

    // *** for develop service category function  ^^^^
    public function service($id)
    {
        $cat_id = 5;
        // Forget a specific session variable
        session()->forget('service_filter_data');

        $ads = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 5)
            ->where('ads.sub_cat_id', $id)
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        return view('web.displayAdsFilters.service', compact('ads', 'id', 'cat_id'));
    }

    public function serviceFilterdRedirect(Request $request)
    {
        $oldFilterDataService = session('service_filter_data', []); // get old session data
        session([
            'service_filter_data' => [
                'min' => $request->min ?? null,
                'max' => $request->max ?? null,
                'subCat' => $request->subCat,
            ]
        ]);

        return redirect()->route('service.filterd.ads');
    }

    public function serviceFilterdDisplay()
    {
        $cat_id = 5;
        $serviceFilterData = session('service_filter_data', []);

        $adsQuery = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 5);

        if (isset($serviceFilterData['subCat'])) {
            $adsQuery->where('ads.sub_cat_id', $serviceFilterData['subCat']);
        }

        if (isset($serviceFilterData['min'])) {
            $adsQuery->where('ads.ads_price', '>=', $serviceFilterData['min']);
        }

        if (isset($serviceFilterData['max'])) {
            $adsQuery->where('ads.ads_price', '<=', $serviceFilterData['max']);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('services', 'ads.id', '=', 'services.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        $id = $serviceFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.service', compact('ads', 'id', 'cat_id'));
    }
    // *** for develop service category function  ^^^^

    // *** for develop jobs category function  ^^^^

    public function jobs($id)
    {
        $cat_id = 6;
        // Forget a specific session variable
        session()->forget('jobs_filter_data');

        $ads = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 6)
            ->where('ads.sub_cat_id', $id)
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('jobs', 'ads.id', '=', 'jobs.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName', 'jobs.sallary_start_from', 'jobs.sallary_start_to')
            ->paginate(12);

        return view('web.displayAdsFilters.jobs', compact('ads', 'id', 'cat_id'));
    }

    public function jobsFilterdRedirect(Request $request)
    {

        session([
            'jobs_filter_data' => [
                'min' => $request->min ?? null,
                'max' => $request->max ?? null,
                'subCat' => $request->subCat,
                // work expirience
                'experience_1' => $request->experience_1 ?? null,
                'experience_2' => $request->experience_2 ?? null,
                'experience_3' => $request->experience_3 ?? null,
                'experience_4' => $request->experience_4 ?? null,
                'experience_5' => $request->experience_5 ?? null,
                'experience_6' => $request->experience_6 ?? null,
                'experience_7' => $request->experience_7 ?? null,
                'experience_8' => $request->experience_8 ?? null,
                'experience_9' => $request->experience_9 ?? null,
                'experience_10' => $request->experience_10 ??  null,
                'experience_more_than_10' => $request->experience_more_than_10 ?? null,
                // education
                'Skilled_Apprentice' => $request->Skilled_Apprentice ?? null,
                'Docterate' => $request->Docterate ?? null,
                'Masters' => $request->Masters ?? null,
                'Degree' => $request->Degree ?? null,
                'Higher_Diploma' => $request->Higher_Diploma ?? null,
                'Diploma' => $request->Diploma ?? null,
                'Certificate' => $request->Certificate ?? null,
                'Advanced_Level' => $request->Advanced_Level ?? null,
                'Ordinary_Level' => $request->Ordinary_Level ?? null,
                // type
                'Full_Time' => $request->Full_Time ?? null,
                'Part_Time' => $request->Part_Time ?? null,
                'Temporary' => $request->Temporary ?? null,
                'Internship' => $request->Internship ?? null,
                'Contractual' => $request->Contractual ?? null,
            ]
        ]);

        return redirect()->route('jobs.filterd.ads');
    }

    public function jobsFilterdDisplay()
    {
        $cat_id = 6;
        $jobsFilterData = session('jobs_filter_data', []);

        $experienceValues = []; // store expirience in a aarray
        if (isset($jobsFilterData['experience_1'])) {
            $experienceValues[] = $jobsFilterData['experience_1'];
        }

        if (isset($jobsFilterData['experience_2'])) {
            $experienceValues[] = $jobsFilterData['experience_2'];
        }
        if (isset($jobsFilterData['experience_3'])) {
            $experienceValues[] = $jobsFilterData['experience_3'];
        }

        if (isset($jobsFilterData['experience_4'])) {
            $experienceValues[] = $jobsFilterData['experience_4'];
        }
        if (isset($jobsFilterData['experience_5'])) {
            $experienceValues[] = $jobsFilterData['experience_5'];
        }

        if (isset($jobsFilterData['experience_6'])) {
            $experienceValues[] = $jobsFilterData['experience_6'];
        }
        if (isset($jobsFilterData['experience_7'])) {
            $experienceValues[] = $jobsFilterData['experience_7'];
        }

        if (isset($jobsFilterData['experience_8'])) {
            $experienceValues[] = $jobsFilterData['experience_8'];
        }
        if (isset($jobsFilterData['experience_9'])) {
            $experienceValues[] = $jobsFilterData['experience_9'];
        }

        if (isset($jobsFilterData['experience_10'])) {
            $experienceValues[] = $jobsFilterData['experience_10'];
        }
        if (isset($jobsFilterData['experience_more_than_10'])) {
            $experienceValues[] = $jobsFilterData['experience_more_than_10'];
        }

        $educationValues = []; // store education in a aarray
        if (isset($jobsFilterData['Ordinary_Level'])) {
            $educationValues[] = $jobsFilterData['Ordinary_Level'];
        }

        if (isset($jobsFilterData['Advanced_Level'])) {
            $educationValues[] = $jobsFilterData['Advanced_Level'];
        }
        if (isset($jobsFilterData['Certificate'])) {
            $educationValues[] = $jobsFilterData['Certificate'];
        }

        if (isset($jobsFilterData['Diploma'])) {
            $educationValues[] = $jobsFilterData['Diploma'];
        }
        if (isset($jobsFilterData['Higher_Diploma'])) {
            $educationValues[] = $jobsFilterData['Higher_Diploma'];
        }

        if (isset($jobsFilterData['Degree'])) {
            $educationValues[] = $jobsFilterData['Degree'];
        }
        if (isset($jobsFilterData['Masters'])) {
            $educationValues[] = $jobsFilterData['Masters'];
        }

        if (isset($jobsFilterData['Docterate'])) {
            $educationValues[] = $jobsFilterData['Docterate'];
        }
        if (isset($jobsFilterData['Skilled_Apprentice'])) {
            $educationValues[] = $jobsFilterData['Skilled_Apprentice'];
        }

        $jobTypeValues = []; // store job type in a array
        if (isset($jobsFilterData['Full_Time'])) {
            $jobTypeValues[] = $jobsFilterData['Full_Time'];
        }
        if (isset($jobsFilterData['Part_Time'])) {
            $jobTypeValues[] = $jobsFilterData['Part_Time'];
        }
        if (isset($jobsFilterData['Temporary'])) {
            $jobTypeValues[] = $jobsFilterData['Temporary'];
        }
        if (isset($jobsFilterData['Internship'])) {
            $jobTypeValues[] = $jobsFilterData['Internship'];
        }
        if (isset($jobsFilterData['Contractual'])) {
            $jobTypeValues[] = $jobsFilterData['Contractual'];
        }


        $adsQuery = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 6);

        if (isset($jobsFilterData['subCat'])) {
            $adsQuery->where('ads.sub_cat_id', $jobsFilterData['subCat']);
        }

        if (isset($jobsFilterData['min'])) {
            $adsQuery->where('jobs.sallary_start_to', '>=', $jobsFilterData['min']);
        }

        if (isset($jobsFilterData['max'])) {
            $adsQuery->where('jobs.sallary_start_from', '<=', $jobsFilterData['max']);
        }
        if (!empty($experienceValues)) {
            $adsQuery->whereIn('jobs.job_work_expirience', $experienceValues);
        }
        if (!empty($educationValues)) {
            $adsQuery->whereIn('jobs.job_education', $educationValues);
        }
        if (!empty($jobTypeValues)) {
            $adsQuery->whereIn('jobs.jobType', $jobTypeValues);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('jobs', 'ads.id', '=', 'jobs.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName', 'jobs.sallary_start_from', 'jobs.sallary_start_to')
            ->paginate(12);


        $id = $jobsFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.jobs', compact('ads', 'id', 'cat_id'));
    }
    // *** for develop jobs category function  ^^^^


    // *** for develop jobs category function  ^^^^
    public function education($id)
    {
        $cat_id = 7;
        session()->forget('education_filter_data');

        $ads = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 7)
            ->where('ads.sub_cat_id', $id)
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('educations', 'ads.id', '=', 'educations.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        return view('web.displayAdsFilters.education', compact('ads', 'id', 'cat_id'));
    }

    public function educationFilterdRedirect(Request $request)
    {
        $oldFilterDataEducation = session('education_filter_data', []); // get old session data
        session([
            'education_filter_data' => [
                'min' => $request->min ?? null,
                'max' => $request->max ?? null,
                'subCat' => $request->subCat,

            ]
        ]);

        return redirect()->route('education.filterd.ads');
    }

    public function educationFilterdDisplay()
    {
        $cat_id = 7;
        $educationFilterData = session('education_filter_data', []);

        $adsQuery = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 7);

        if (isset($educationFilterData['subCat'])) {
            $adsQuery->where('ads.sub_cat_id', $educationFilterData['subCat']);
        }

        if (isset($educationFilterData['min'])) {
            $adsQuery->where('ads.ads_price', '>=', $educationFilterData['min']);
        }

        if (isset($educationFilterData['max'])) {
            $adsQuery->where('ads.ads_price', '<=', $educationFilterData['max']);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('educations', 'ads.id', '=', 'educations.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        $id = $educationFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.education', compact('ads', 'id', 'cat_id'));
    }
}
