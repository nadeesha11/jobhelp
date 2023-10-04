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

        return view('web.displayAdsFilters.electronics', compact('ads', 'id'));
    }

    public function electronicsFilterdRedirect(Request $request)
    {
        $oldFilterData = session('electronics_filter_data', []); // get old session data
        session([
            'electronics_filter_data' => [
                'min' => $request->min ?? ($oldFilterData['min'] ?? null),
                'max' => $request->max ?? ($oldFilterData['max'] ?? null),
                'subCat' => $request->subCat ?? ($oldFilterData['subCat'] ?? null),
                'new' => $request->new ?? null, // dont need old data
                'used' => $request->used ?? null, // dont need old data
            ]
        ]);
        return redirect()->route('electronics.filterd.ads');
    }

    public function electronicsFilterdDisplay(Request $request)
    {

        $adsQuery = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 2);

        $electronicsFilterData = session('electronics_filter_data', []);

        if (isset($electronicsFilterData['subCat'])) {
            $adsQuery->where('ads.sub_cat_id', $electronicsFilterData['subCat']);
        }
        if (isset($electronicsFilterData['min'])) {
            $adsQuery->where('ads.ads_price', '>=', $electronicsFilterData['min']);
        }
        if (isset($electronicsFilterData['max'])) {
            $adsQuery->where('ads.ads_price', '<=', $electronicsFilterData['max']);
        }
        if (isset($electronicsFilterData['new'])) {
            $adsQuery->where('electronics.ele_condition', $electronicsFilterData['new']);
        }
        if (isset($electronicsFilterData['used'])) {
            $adsQuery->where('electronics.ele_condition', $electronicsFilterData['used']);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('electronics', 'ads.id', '=', 'electronics.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);



        $id = $electronicsFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.electronics', compact('ads', 'id'));
    }
    // *** for develop electronics category functions ^^^^

    // *** for develop vehicles category functions 
    protected function vehicles($id)
    {
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

        return view('web.displayAdsFilters.vehicles', compact('ads', 'id'));
    }

    public function vehiclesFilterdRedirect(Request $request)
    {

        $oldFilterDataVehicle = session('vehicle_filter_data', []); // get old session data
        session([
            'vehicle_filter_data' => [
                'min' => $request->min ?? ($oldFilterDataVehicle['min'] ?? null),
                'max' => $request->max ?? ($oldFilterDataVehicle['max'] ?? null),
                'subCat' => $request->subCat,
                'New' => $request->New ?? null, // dont need old data
                'Used' => $request->Used ?? null, // dont need old data
                'Reconditioned' => $request->Reconditioned ?? null, // dont need old data
            ]
        ]);

        return redirect()->route('vehicles.filterd.ads');
    }

    public function vehiclesFilterdDisplay(Request $request)
    {
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

        if (isset($vehiclesFilterData['New'])) {
            $adsQuery->where('vehicle.condition',  $vehiclesFilterData['New']);
        }

        if (isset($vehiclesFilterData['Used'])) {
            $adsQuery->where('vehicle.condition',  $vehiclesFilterData['Used']);
        }

        if (isset($vehiclesFilterData['Reconditioned'])) {
            $adsQuery->where('vehicle.condition',  $vehiclesFilterData['Reconditioned']);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('vehicle', 'ads.id', '=', 'vehicle.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        $id = $vehiclesFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.vehicles', compact('ads', 'id'));
    }

    // *** for develop vehicles category functions ^^^^

    // *** for develop property category function  ^^^^
    public function property($id)
    {
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

        return view('web.displayAdsFilters.property', compact('ads', 'id'));
    }

    public function propertyFilterdRedirect(Request $request)
    {
        $oldFilterDataProperty = session('property_filter_data', []); // get old session data
        session([
            'property_filter_data' => [
                'min' => $request->min ?? ($oldFilterDataProperty['min'] ?? null),
                'max' => $request->max ?? ($oldFilterDataProperty['max'] ?? null),
                'subCat' => $request->subCat,
            ]
        ]);

        return redirect()->route('property.filterd.ads');
    }

    public function propertyFilterdDisplay()
    {
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

        return view('web.displayAdsFilters.property', compact('ads', 'id'));
    }

    // *** for develop property category function  ^^^^

    // *** for develop service category function  ^^^^
    public function service($id)
    {
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

        return view('web.displayAdsFilters.service', compact('ads', 'id'));
    }

    public function serviceFilterdRedirect(Request $request)
    {
        $oldFilterDataService = session('service_filter_data', []); // get old session data
        session([
            'service_filter_data' => [
                'min' => $request->min ?? ($oldFilterDataService['min'] ?? null),
                'max' => $request->max ?? ($oldFilterDataService['max'] ?? null),
                'subCat' => $request->subCat,
            ]
        ]);

        return redirect()->route('service.filterd.ads');
    }

    public function serviceFilterdDisplay()
    {
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

        return view('web.displayAdsFilters.service', compact('ads', 'id'));
    }
    // *** for develop service category function  ^^^^

    // *** for develop jobs category function  ^^^^

    public function jobs($id)
    {    // Forget a specific session variable
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

        return view('web.displayAdsFilters.jobs', compact('ads', 'id'));
    }

    public function jobsFilterdRedirect(Request $request)
    {
        $oldFilterDataJobs = session('jobs_filter_data', []); // get old session data
        session([
            'jobs_filter_data' => [
                'min' => $request->min ?? ($oldFilterDataJobs['min'] ?? null),
                'max' => $request->max ?? ($oldFilterDataJobs['max'] ?? null),
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

        return view('web.displayAdsFilters.jobs', compact('ads', 'id'));
    }
    // *** for develop jobs category function  ^^^^


    // *** for develop jobs category function  ^^^^
    public function education($id)
    {
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

        return view('web.displayAdsFilters.education', compact('ads', 'id'));
    }

    public function educationFilterdRedirect(Request $request)
    {
        $oldFilterDataEducation = session('education_filter_data', []); // get old session data
        session([
            'education_filter_data' => [
                'min' => $request->min ?? ($oldFilterDataEducation['min'] ?? null),
                'max' => $request->max ?? ($oldFilterDataEducation['max'] ?? null),
                'subCat' => $request->subCat,

            ]
        ]);

        return redirect()->route('education.filterd.ads');
    }

    public function educationFilterdDisplay()
    {
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

        return view('web.displayAdsFilters.education', compact('ads', 'id'));
    }
}
