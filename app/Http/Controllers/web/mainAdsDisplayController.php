<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mainAdsDisplayController extends Controller
{
    public function index($id)
    {

        switch ($id) {
            case '2':
                // Logic for electronics

                $subCategory =  subCategory::where('cat_id', $id)->get();
                $ads = DB::table('ads')
                    ->where('ads.status', 1)
                    ->where('ads.cat_id', $id)
                    ->orderBy('ads.id', 'desc')
                    ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
                    ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
                    ->paginate(12);

                return view('web.displayAdsMain.electronics', compact('ads', 'subCategory'));
                break;

            case '3':
                // Logic for vehicle
                $subCategory =  subCategory::where('cat_id', $id)->get();
                $ads = DB::table('ads')
                    ->where('ads.status', 1)
                    ->where('ads.cat_id', $id)
                    ->orderBy('ads.id', 'desc')
                    ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
                    ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
                    ->paginate(12);
                return view('web.displayAdsMain.vehicles', compact('ads', 'subCategory'));
                break;

            case '4':
                // Logic for property
                $subCategory =  subCategory::where('cat_id', $id)->get();
                $ads = DB::table('ads')
                    ->where('ads.status', 1)
                    ->where('ads.cat_id', $id)
                    ->orderBy('ads.id', 'desc')
                    ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
                    ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
                    ->paginate(12);
                return view('web.displayAdsMain.property', compact('ads', 'subCategory'));
                break;

            case '5':
                // Logic for service
                $subCategory =  subCategory::where('cat_id', $id)->get();
                $ads = DB::table('ads')
                    ->where('ads.status', 1)
                    ->where('ads.cat_id', $id)
                    ->orderBy('ads.id', 'desc')
                    ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
                    ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
                    ->paginate(12);
                return view('web.displayAdsMain.service', compact('ads', 'subCategory'));
                break;

            case '6':
                // Logic for jobs
                $subCategory =  subCategory::where('cat_id', $id)->get();
                $ads = DB::table('ads')
                    ->where('ads.status', 1)
                    ->where('ads.cat_id', $id)
                    ->orderBy('ads.id', 'desc')
                    ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
                    ->join('jobs', 'ads.id', '=', 'jobs.ads_id')
                    ->select('ads.*', 'subcategory.sub_cat_name as subCatName', 'jobs.sallary_start_from', 'jobs.sallary_start_to')
                    ->paginate(12);
                return view('web.displayAdsMain.jobs', compact('ads', 'subCategory'));
                break;

            case '7':
                // Logic for education
                $subCategory =  subCategory::where('cat_id', $id)->get();
                $ads = DB::table('ads')
                    ->where('ads.status', 1)
                    ->where('ads.cat_id', $id)
                    ->orderBy('ads.id', 'desc')
                    ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
                    ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
                    ->paginate(12);
                return view('web.displayAdsMain.education', compact('ads', 'subCategory'));
                break;

            default:
                // Default logic
                return "error page";
                break;
        }
    }

    public function detailedElectronic($id)
    {
        $ads_subcategory = DB::table('ads')->where('id', $id)->pluck('sub_cat_id')->first();
        $images = DB::table('ads_image')->where('ads_id', $id)->pluck('image_name');
        $main_image = DB::table('ads')->where('id', $id)->pluck('ads_main_image')->first();
        // $images->push($main_image);

        $imageArray = [$main_image, ...$images];

        $ads = DB::table('ads')
            ->where('ads.id', $id)
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('category', 'ads.cat_id', '=', 'category.id')
            ->join('users', 'ads.user_id', '=', 'users.id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName', 'category.cat_name as cat_name', 'users.first_name', 'users.last_name', 'users.phone_number', 'users.created_at AS joined', 'ads.ads_description AS desc', 'users.email AS email')
            ->first();

        // get electronic table id
        $electronic_id = DB::table('electronics')->where('ads_id', $id)->pluck('id');
        //  get feature data

        // get electronic table data 
        $ads_electronic = DB::table('electronics')
            ->where('electronics.ads_id', $id)
            ->leftJoin('subcategory_brands', 'electronics.brands_id', '=', 'subcategory_brands.id')
            ->leftJoin('brandmodel', 'electronics.models_id', '=', 'brandmodel.id')
            ->leftJoin('sub_category_types', 'electronics.sub_catgeory_types_id', '=', 'sub_category_types.id')
            ->select('electronics.*', 'subcategory_brands.brand_name', 'brandmodel.model_name', 'sub_category_types.sct_name AS sct_name')
            ->first();

        return view('web.detailedAds.detailedAdsElectronics', compact('images', 'imageArray', 'main_image', 'ads', 'ads_electronic', 'ads_subcategory'));
    }
    public function detailedVehicle($id)
    {
        $ads_subcategory = DB::table('ads')->where('id', $id)->pluck('sub_cat_id')->first();
        $images = DB::table('ads_image')->where('ads_id', $id)->pluck('image_name');
        $main_image = DB::table('ads')->where('id', $id)->pluck('ads_main_image')->first();
        // $images->push($main_image);

        $imageArray = [$main_image, ...$images];

        $ads = DB::table('ads')
            ->where('ads.id', $id)
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('category', 'ads.cat_id', '=', 'category.id')
            ->join('users', 'ads.user_id', '=', 'users.id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName', 'category.cat_name as cat_name', 'users.first_name', 'users.last_name', 'users.phone_number', 'users.created_at AS joined', 'ads.ads_description AS desc', 'users.email AS email')
            ->first();

        // get electronic table id
        $electronic_id = DB::table('vehicle')->where('ads_id', $id)->pluck('id');
        //  get feature data

        // get electronic table data 
        $ads_vehicle = DB::table('vehicle')
            ->where('vehicle.ads_id', $id)
            ->leftJoin('subcategory_brands', 'vehicle.brands_id', '=', 'subcategory_brands.id')
            ->leftJoin('brandmodel', 'vehicle.models_id', '=', 'brandmodel.id')
            ->leftJoin('sub_category_types', 'vehicle.sub_category_types_id', '=', 'sub_category_types.id')
            ->select('vehicle.*', 'subcategory_brands.brand_name', 'brandmodel.model_name', 'sub_category_types.sct_name AS sct_name')
            ->first();

        return view('web.detailedAds.detailedAdsVehicle', compact('images', 'imageArray', 'main_image', 'ads', 'ads_vehicle', 'ads_subcategory'));
    }
    public function detailedProperty($id)
    {

        $ads_subcategory = DB::table('ads')->where('id', $id)->pluck('sub_cat_id')->first();
        $images = DB::table('ads_image')->where('ads_id', $id)->pluck('image_name');
        $main_image = DB::table('ads')->where('id', $id)->pluck('ads_main_image')->first();
        // $images->push($main_image);

        $imageArray = [$main_image, ...$images];

        $ads = DB::table('ads')
            ->where('ads.id', $id)
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('category', 'ads.cat_id', '=', 'category.id')
            ->join('users', 'ads.user_id', '=', 'users.id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName', 'category.cat_name as cat_name', 'users.first_name', 'users.last_name', 'users.phone_number', 'users.created_at AS joined', 'ads.ads_description AS desc', 'users.email AS email')
            ->first();

        // get property table data 
        $ads_property = DB::table('property')
            ->where('property.ads_id', $id)
            ->select('property.*')
            ->first();

        return view('web.detailedAds.detailedAdsProperty', compact('images', 'imageArray', 'main_image', 'ads', 'ads_property', 'ads_subcategory'));
    }
    public function detailedService($id)
    {
        $ads_subcategory = DB::table('ads')->where('id', $id)->pluck('sub_cat_id')->first();
        $images = DB::table('ads_image')->where('ads_id', $id)->pluck('image_name');
        $main_image = DB::table('ads')->where('id', $id)->pluck('ads_main_image')->first();
        // $images->push($main_image);

        $imageArray = [$main_image, ...$images];

        $ads = DB::table('ads')
            ->where('ads.id', $id)
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('category', 'ads.cat_id', '=', 'category.id')
            ->join('users', 'ads.user_id', '=', 'users.id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName', 'category.cat_name as cat_name', 'users.first_name', 'users.last_name', 'users.phone_number', 'users.created_at AS joined', 'ads.ads_description AS desc', 'users.email AS email')
            ->first();

        // get property table data 
        $ads_service = DB::table('services')
            ->where('services.ads_id', $id)
            ->join('sub_category_types', 'services.sub_cat_types_id', '=', 'sub_category_types.id')
            ->select('services.*', 'sub_category_types.sct_name')
            ->first();

        return view('web.detailedAds.detailedAdsService', compact('images', 'imageArray', 'main_image', 'ads', 'ads_service', 'ads_subcategory'));
    }
    public function detailedJobs($id)
    {
        $ads_subcategory = DB::table('ads')->where('id', $id)->pluck('sub_cat_id')->first();
        $images = DB::table('ads_image')->where('ads_id', $id)->pluck('image_name');
        $main_image = DB::table('ads')->where('id', $id)->pluck('ads_main_image')->first();

        $imageArray = [$main_image, ...$images];

        $ads = DB::table('ads')
            ->where('ads.id', $id)
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('category', 'ads.cat_id', '=', 'category.id')
            ->join('users', 'ads.user_id', '=', 'users.id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName', 'category.cat_name as cat_name', 'users.first_name', 'users.last_name', 'users.phone_number', 'users.created_at AS joined', 'ads.ads_description AS desc', 'users.email AS email')
            ->first();

        // get property table data 
        $ads_jobs = DB::table('jobs')
            ->where('jobs.ads_id', $id)
            ->first();

        return view('web.detailedAds.detailedAdsJobs', compact('images', 'imageArray', 'main_image', 'ads', 'ads_jobs', 'ads_subcategory'));
    }
    public function detailedEducation($id)
    {
        // this code should recreated tomorrow
        $ads_subcategory = DB::table('ads')->where('id', $id)->pluck('sub_cat_id')->first();
        $images = DB::table('ads_image')->where('ads_id', $id)->pluck('image_name');
        $main_image = DB::table('ads')->where('id', $id)->pluck('ads_main_image')->first();

        $imageArray = [$main_image, ...$images];

        $ads = DB::table('ads')
            ->where('ads.id', $id)
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('category', 'ads.cat_id', '=', 'category.id')
            ->join('users', 'ads.user_id', '=', 'users.id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName', 'category.cat_name as cat_name', 'users.first_name', 'users.last_name', 'users.phone_number', 'users.created_at AS joined', 'ads.ads_description AS desc', 'users.email AS email')
            ->first();

        // get property table data 
        $ads_education = DB::table('educations')
            ->join('sub_category_types', 'educations.subCategoryTypesId', '=', 'sub_category_types.id')
            ->where('educations.ads_id', $id)
            ->first();

        return view('web.detailedAds.detailedAdsEducation', compact('images', 'imageArray', 'main_image', 'ads', 'ads_education', 'ads_subcategory'));
    }
}
