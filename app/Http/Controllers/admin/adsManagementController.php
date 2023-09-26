<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adsManagementController extends Controller
{
    public function index()
    {
        return view('adminPanel.adsManagement.adsManagement');
    }
    public function recieveData()
    {
        $data = DB::table('ads')
            ->orderBy('id', 'desc') // Order by the 'created_at' column in descending order
            ->get();

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    $status = '<span class="badge badge-pill badge-success mb-1">Active</span>';
                } else {
                    $status = '<span class="badge badge-pill badge-danger mb-1">Inactive</span>';
                }
                return $status;
            })
            ->addColumn('action', function ($data) {
                $btn = '<a  href="javascript:void(0)"   data-id="' . $data->id . '" class="action btn btn-warning btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
                return $btn;
            })
            ->addColumn('ads_type', function ($data) {
                $package = DB::table('ads_types')->where('id', $data->ads_type)->pluck('ads_package_id')->first();
                if ($package == null) {
                    $status = '<span class="badge badge-pill badge-success mb-1">normal ad</span>';
                } else if ($package == 1) {
                    $status = '<span class="badge badge-pill badge-danger mb-1">Top Ads</span>';
                } else if ($package == 2) {
                    $status = '<span class="badge badge-pill badge-danger mb-1">Urgent Ads</span>';
                } else if ($package == 3) {
                    $status = '<span class="badge badge-pill badge-danger mb-1">Spotlight Ads</span>';
                }
                return $status;
            })
            ->addColumn('more', function ($data) {
                $btn = '<a  href="javascript:void(0)"   data-id="' . $data->id . '" class="more btn btn-info btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
                return $btn;
            })
            ->rawColumns(['status', 'more', 'ads_type', 'action'])
            ->make(true);
    }
    public function detailed($id)
    {
        $ads_category = DB::table('ads')->where('id', $id)->pluck('cat_id')->first(); // get main category

        switch ($ads_category) { // this is electronics
            case 2:
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

                return view('adminPanel.adsDetailed.adsDetailedElec', compact('images', 'imageArray', 'main_image', 'ads', 'ads_electronic', 'ads_subcategory'));
                break;
            case 3:
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

                return view('adminPanel.adsDetailed.adsDetailedVehicle', compact('images', 'imageArray', 'main_image', 'ads', 'ads_vehicle', 'ads_subcategory'));
                break;
            case 4:
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

                return view('adminPanel.adsDetailed.adsDetailedProperty', compact('images', 'imageArray', 'main_image', 'ads', 'ads_property', 'ads_subcategory'));
                break;
            case 5:
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

                return view('adminPanel.adsDetailed.adsDetailedService', compact('images', 'imageArray', 'main_image', 'ads', 'ads_service', 'ads_subcategory'));
                break;
            case 6: // jobs
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

                return view('adminPanel.adsDetailed.adsDetailedJobs', compact('images', 'imageArray', 'main_image', 'ads', 'ads_jobs', 'ads_subcategory'));

                break;
            case 7:
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

                return view('adminPanel.adsDetailed.adsDetailedEducation', compact('images', 'imageArray', 'main_image', 'ads', 'ads_education', 'ads_subcategory'));
                break;
            default:
                echo 'Code to execute if $variable doesn match any case';
                break;
        }

        // $ads_status = DB::table('ads')->where('id', $id)->pluck('status')->first();
        // return view('adminPanel.adsDetailed.adsDetailed', compact('ads_status', 'id'));
    }
    public function statusChange(Request $request)
    {

        try {
            // Use $request->getContent() to get the raw JSON data from the request
            $jsonData = $request->getContent();

            // Use json_decode with the second parameter set to true to decode JSON into an associative array
            $data = json_decode($jsonData, true);

            // Check if $data is not null and contains the expected keys
            $result = DB::table('ads')->where('id', $data['ad_id'])->update([
                'status' => 0
            ]);

            if ($result) {
                return response()->json(['code' => 1, 'msg' => 'ad status updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'something went wrong']);
            }
        } catch (\Throwable $th) {
            return response()->json(['code' => 2, 'msg' => $th->getMessage()]);
        }
    }
    public function more($id)
    {
        $data = DB::table('ads')->where('id', $id)->first();
        return $data;
    }
    public function updateStatus(Request $request)
    {
        try {

            $status = (isset($request->status)) ? 1 : 0;

            // Check if $data is not null and contains the expected keys
            $result = DB::table('ads')->where('id', $request->id)->update([
                'status' => $status
            ]);

            if ($result) {
                return response()->json(['code' => 1, 'msg' => 'ad status updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'something went wrong']);
            }
        } catch (\Throwable $th) {
            return response()->json(['code' => 2, 'msg' => $th->getMessage()]);
        }
    }
}
