<?php

namespace App\Http\Controllers\web;

use App\Contracts\AdsInterface;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class paymentController extends Controller
{
    public $ads;
    function __construct(AdsInterface $ads)
    {
        $this->ads = $ads;
    }

    public function freeAds(Request $request)
    {
        $key = session('vendorLogin');
        $userData = DB::table('users')->where('key', $key)->first(); // logged user data
        return view('web.payment.freeAds', compact('userData', 'request'));
    }
    public function payedAds(Request $request)
    {
        // Retrieve the JSON-encoded data from the session
        $tempartPayAdsDataJson = Session::get('tempartPayAdsData');

        // Decode the JSON string into an associative array
        $tempartPayAdsData = json_decode($tempartPayAdsDataJson, true);

        $key = session('vendorLogin');
        $userData = DB::table('users')->where('key', $key)->first(); // logged user data
        return view('web.payment.payedAds', compact('userData', 'tempartPayAdsData', 'request'));
    }
    public function successFreePay(Request $request)
    {
        try {

            $duration = DB::table('ads_types')->find($request->ad_type); //  get package duration
            $result = DB::table('ads')->where('id', $request->ads_id)->update([
                'ads_type' => $request->ad_type,
                'package_expire' => Carbon::now()->addDays($duration->duration)
            ]);
            if ($result) {
                return response()->json([
                    'code' => 'success'
                ]);
            } else {
                return response()->json([
                    'code' => 'fail'
                ]);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'error' => $th->getMessage()
            ]);
        }
    }
    public function successPayAds(Request $request)
    {

        // Retrieve the JSON-encoded data from the session
        $tempartPayAdsDataJson = Session::get('tempartPayAdsData');
        // Decode the JSON string into an associative array
        $tempartPayAdsData = json_decode($tempartPayAdsDataJson, true);
        // Access the 'request_data' field from the decoded data
        $data = $tempartPayAdsData['request_data'];

        // images 
        $main_image = $tempartPayAdsData['main_image'];
        $image_one = $tempartPayAdsData['image_one'];
        $image_two = $tempartPayAdsData['image_two'];
        $image_three = $tempartPayAdsData['image_three'];

        $duration = DB::table('ads_types')->find($request->ad_type); //  get package duration
        $sub_category_name = DB::table('subcategory')->where('id', $data['sub_category_id'])->pluck('sub_cat_name')->first();
        if ($tempartPayAdsData['category'] === 'service') {

            $last_inerted_id = DB::table('ads')->insertGetId(array( //insert data to main ad table and get id
                'ads_location' => $data['ads_location'],
                'ads_sublocation' => $data['ads_sublocation'],
                'ads_title' => $data['title'],
                'ads_description' => $data['description'],
                'ads_sub_cat_name' => $sub_category_name,
                'ads_price' => $data['price'],
                'ads_main_image' => $main_image,
                'status' => 0,
                'user_id' => $data['user_id'],
                'sub_cat_id' => $data['sub_category_id'],
                'cat_id' => $data['category_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'ads_type' => $request->ad_type,
                'package_expire' => Carbon::now()->addDays($duration->duration),
            ));

            //   insert other images into db start
            if (isset($image_one)) {
                DB::table('ads_image')->insert([array(
                    'image_name' => $image_one,
                    'ads_id' => $last_inerted_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                )]);
            }
            if (isset($image_two)) {
                DB::table('ads_image')->insert([array(
                    'image_name' => $image_two,
                    'ads_id' => $last_inerted_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                )]);
            }
            if (isset($image_three)) {
                DB::table('ads_image')->insert([array(
                    'image_name' => $image_three,
                    'ads_id' => $last_inerted_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                )]);
            }
            // insert other images into db start

            $data_insert = [
                'price_negotiable' => $data['negotiable'] ?? null,
                'sub_cat_types_id' => $data['serviceType'] ?? null,
                'ads_id' => $last_inerted_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            //start  create education table data 
            $education_inserted = DB::table('services')->insert($data_insert);
            //end  create education table data 

            // send success message 
            if ($education_inserted) {
                // check is this free ads or payed
                $key = Session::get('vendorLogin');
                DB::table('users')
                    ->where('key', $key)
                    ->where('free', '>', 0) // Check if 'free' is greater than 0
                    ->decrement('free', 1);
                return response()->json(['code' => 'true', 'msg' => 'Ad Created ', 'last_inerted_id' => $last_inerted_id]);
            } else {
                return response()->json(['code' => 'false', 'msg' => 'Something Went Wrong !']);
            }
        } else if ($tempartPayAdsData['category'] === 'jobs') {

            $sub_category_name = DB::table('subcategory')->where('id', $data['sub_category_id'])->pluck('sub_cat_name')->first();

            $last_inerted_id = DB::table('ads')->insertGetId(array( //insert data to main ad table and get id
                'ads_location' => $data['ads_location'],
                'ads_sublocation' => $data['ads_sublocation'],
                'ads_title' => $data['title'],
                'ads_description' => $data['description'],
                'ads_sub_cat_name' => $sub_category_name,
                'ads_price' => $data['price'],
                'ads_main_image' => $main_image,
                'status' => 0,
                'user_id' => $data['user_id'],
                'sub_cat_id' => $data['sub_category_id'],
                'cat_id' => $data['category_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'ads_type' => $request->ad_type,
                'package_expire' => Carbon::now()->addDays($duration->duration),
            ));

            //   insert other images into db start
            if (isset($image_one)) {
                DB::table('ads_image')->insert([array(
                    'image_name' => $image_one,
                    'ads_id' => $last_inerted_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                )]);
            }
            if (isset($image_two)) {
                DB::table('ads_image')->insert([array(
                    'image_name' => $image_two,
                    'ads_id' => $last_inerted_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                )]);
            }
            if (isset($image_three)) {
                DB::table('ads_image')->insert([array(
                    'image_name' => $image_three,
                    'ads_id' => $last_inerted_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                )]);
            }
            // insert other images into db start

            $data_insert = [
                'jobType' => $data['jobType'] ?? null,
                'job_work_expirience' => $data['job_work_expirience'] ?? null,
                'job_education' => $data['job_education'] ?? null,
                'ads_id' => $last_inerted_id,
                'jobs_application_deadline' => $data['jobs_application_deadline'] ?? null,
                'sallary_start_from' => $data['sallary_start_from'] ?? null,
                'sallary_start_to' => $data['sallary_start_to'] ?? null,

                'job_employer' => $data['job_employer'] ?? null,
                'job_employer_website' => $data['job_employer_website'] ?? null,
            ];

            //start  create education table data 
            $jobs_inserted = DB::table('jobs')->insert($data_insert);
            //end  create education table data 

            // send success message 
            if ($jobs_inserted) {
                // check is this free ads or payed
                $key = Session::get('vendorLogin');
                DB::table('users')
                    ->where('key', $key)
                    ->where('free', '>', 0) // Check if 'free' is greater than 0
                    ->decrement('free', 1);
                return response()->json(['code' => 'true', 'msg' => 'Ad Created ', 'last_inerted_id' => $last_inerted_id]);
            } else {
                return response()->json(['code' => 'false', 'msg' => 'Something Went Wrong !']);
            }
        } else if ($tempartPayAdsData['category'] === 'property') {

            $sub_category_name = DB::table('subcategory')->where('id', $data['sub_category_id'])->pluck('sub_cat_name')->first();

            $last_inerted_id = DB::table('ads')->insertGetId(array( //insert data to main ad table and get id
                'ads_location' => $data['ads_location'],
                'ads_sublocation' => $data['ads_sublocation'],
                'ads_title' => $data['title'],
                'ads_description' => $data['description'],
                'ads_sub_cat_name' => $sub_category_name,
                'ads_price' => $data['price'],
                'ads_main_image' => $main_image,
                'status' => 0,
                'user_id' => $data['user_id'],
                'sub_cat_id' => $data['sub_category_id'],
                'cat_id' => $data['category_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'ads_type' => $request->ad_type,
                'package_expire' => Carbon::now()->addDays($duration->duration),
            ));

            //   insert other images into db start
            if ($image_one) {

                DB::table('ads_image')->insert([array(
                    'image_name' => $image_one,
                    'ads_id' => $last_inerted_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                )]);
            }
            if ($image_two) {

                DB::table('ads_image')->insert([array(
                    'image_name' => $image_two,
                    'ads_id' => $last_inerted_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                )]);
            }
            if ($image_three) {

                DB::table('ads_image')->insert([array(
                    'image_name' => $image_three,
                    'ads_id' => $last_inerted_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                )]);
            }
            // insert other images into db start

            $data_insert = [
                'ads_id' => $last_inerted_id,
                'address' => $data['address'],
                'bedrooms' => $data['bedrooms'] ?? null,
                'bathrooms' => $data['bathrooms'] ?? null,
                'house_size' => $data['house_size'] ?? null,
                'land_type' => $data['land_type'] ?? null,
                'landSize' => $data['landSize'] ?? null,
                'landSize_measure' => $data['landSizeType'] ?? null,
                'unit_price' => $data['unit_price'] ?? null,
                'unit_price_measure' => $data['UnitPriceType'] ?? null,
                'negotiable' => $data['negotiable'] ?? null,
            ];

            //start  create education table data 
            $jobs_inserted = DB::table('property')->insert($data_insert);
            //end  create education table data 

            // send success message 
            if ($jobs_inserted) {
                // check is this free ads or payed
                $key = Session::get('vendorLogin');
                DB::table('users')
                    ->where('key', $key)
                    ->where('free', '>', 0) // Check if 'free' is greater than 0
                    ->decrement('free', 1);
                return response()->json(['code' => 'true', 'msg' => 'Ad Created ', 'last_inerted_id' => $last_inerted_id,]);
            } else {
                return response()->json(['code' => 'false', 'msg' => 'Something Went Wrong !']);
            }
        } else if ($tempartPayAdsData['category'] === 'vehicle') {

            $sub_category_name = DB::table('subcategory')->where('id', $data['sub_category_id'])->pluck('sub_cat_name')->first();

            $last_inerted_id = DB::table('ads')->insertGetId(array( //insert data to main ad table and get id
                'ads_location' => $data['ads_location'],
                'ads_sublocation' => $data['ads_sublocation'],
                'ads_title' => $data['title'],
                'ads_description' => $data['description'],
                'ads_sub_cat_name' => $sub_category_name,
                'ads_price' => $data['price'],
                'ads_main_image' => $main_image,
                'status' => 0,
                'user_id' => $data['user_id'],
                'sub_cat_id' => $data['sub_category_id'],
                'cat_id' => $data['category_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

                'ads_type' => $request->ad_type,
                'package_expire' => Carbon::now()->addDays($duration->duration),
            ));

            $image_data = [ // rename and uplodad sub images
                [
                    'image_name' => $image_one,
                    'ads_id' => $last_inerted_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'image_name' => $image_two,
                    'ads_id' => $last_inerted_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'image_name' => $image_three,
                    'ads_id' => $last_inerted_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ];

            DB::table('ads_image')->insert($image_data); //insert data to db

            //   check customize input and set default value(1{seeded value} ) or if not null, pass to original value 
            $type_default = '';
            $brand_default = '';
            $model_default = '';

            if (isset($data['VehicleType'])) {
                $type_default = $data['VehicleType'];
            } else {
                $type_default = 1;  //this default values because we cant pass null values to forign ids  
            }
            if (isset($data['brand'])) {
                $brand_default = $data['brand'];
            } else {
                $brand_default = 1;  //this default values because we cant pass null values to forign ids  
            }
            if (isset($data['model'])) {
                $model_default = $data['model'];
            } else {
                $model_default = 1;  //this default values because we cant pass null values to forign ids  
            }

            $data_insert = [
                'condition' => $data['Condition'] ?? null,
                'edition' => $data['Edition'] ?? null,
                'manufacture_year' => $data['YearOfManufacture'] ?? null,
                'milage' => $data['Mileage'] ?? null,

                'engine_capacity' => $data['Enginecapacity'] ?? null,
                'fuel_type' => $data['fuel_type'] ?? null,
                'transmission' => $data['Transmission'] ?? null,

                'body_type' => $data['Bodytype'] ?? null,
                'price_negotiable' => $data['negotiable'] ?? null,
                'ads_id' => $last_inerted_id,
                'brands_id' => $brand_default,

                'models_id' => $model_default,
                'sub_category_types_id' => $type_default,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            //start  create electronic table data 
            $vehicle_last_inserted = DB::table('vehicle')->insertGetId($data_insert);
            //end  create electronic table data 

            // send success message 
            if ($vehicle_last_inserted) {
                // check is this free ads or payed
                $key = Session::get('vendorLogin');
                DB::table('users')
                    ->where('key', $key)
                    ->where('free', '>', 0) // Check if 'free' is greater than 0
                    ->decrement('free', 1);
                return response()->json(['code' => 'true', 'msg' => 'Ad Created ', 'last_inerted_id' => $last_inerted_id]);
            } else {
                return response()->json(['code' => 'false', 'msg' => 'Something Went Wrong !']);
            }
        } else if ($tempartPayAdsData['category'] === 'education') {

            $sub_category_name = DB::table('subcategory')->where('id', $data['sub_category_id'])->pluck('sub_cat_name')->first();

            $last_inerted_id = DB::table('ads')->insertGetId(array( //insert data to main ad table and get id
                'ads_location' => $data['ads_location'],
                'ads_sublocation' => $data['ads_sublocation'],
                'ads_title' => $data['title'],
                'ads_description' => $data['description'],
                'ads_sub_cat_name' => $sub_category_name,
                'ads_price' => $data['price'],
                'ads_main_image' => $main_image,
                'status' => 0,
                'user_id' => $data['user_id'],
                'sub_cat_id' => $data['sub_category_id'],
                'cat_id' => $data['category_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'ads_type' => $request->ad_type,
                'package_expire' => Carbon::now()->addDays($duration->duration),
            ));

            //   insert other images into db start
            if ($image_one) {
                DB::table('ads_image')->insert([array(
                    'image_name' => $image_one,
                    'ads_id' => $last_inerted_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                )]);
            }
            if ($image_two) {
                $image_two = time() . rand(1, 1000) . '.' . $data['image_two']->extension();
                $data['image_two']->move(public_path("ad_image/sub_images"), $image_two); //rename image and upload public
                DB::table('ads_image')->insert([array(
                    'image_name' => $image_two,
                    'ads_id' => $last_inerted_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                )]);
            }
            if ($image_three) {
                $image_three = time() . rand(1, 1000) . '.' . $data['image_three']->extension();
                $data['image_three']->move(public_path("ad_image/sub_images"), $image_three); //rename image and upload public
                DB::table('ads_image')->insert([array(
                    'image_name' => $image_three,
                    'ads_id' => $last_inerted_id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                )]);
            }
            // insert other images into db start

            // check customize input and set default value(1{seeded value} ) or if not null, pass to original value 
            $type_default = '';
            if (isset($data['educationType'])) {
                $type_default = $data['educationType'];
            } else {
                $type_default = 1;  //this default values because we cant pass null values to forign ids  
            }

            $data_insert = [
                'price_negotiable' => $data['negotiable'] ?? null,
                'edu_condition' => $data['Condition'] ?? null,
                'ads_id' => $last_inerted_id,
                'subCategoryTypesId' => $type_default,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];

            //start  create education table data 
            $education_inserted = DB::table('educations')->insert($data_insert);
            //end  create education table data 

            // send success message 
            if ($education_inserted) {
                // check is this free ads or payed
                $key = Session::get('vendorLogin');
                DB::table('users')
                    ->where('key', $key)
                    ->where('free', '>', 0) // Check if 'free' is greater than 0
                    ->decrement('free', 1);
                return response()->json(['code' => 'true', 'msg' => 'Ad Created ', 'last_inerted_id' => $last_inerted_id]);
            } else {
                return response()->json(['code' => 'false', 'msg' => 'Something Went Wrong !']);
            }
        }
    }
}
