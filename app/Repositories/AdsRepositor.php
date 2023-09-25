<?php

namespace App\Repositories;

use App\Contracts\AdsInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdsRepositor implements AdsInterface
{
    public function create_property(array $data)
    {

        //deal with main image
        $main_image = time() . rand(1, 1000) . '.' . $data['main_image']->extension();
        $data['main_image']->move(public_path("ad_image/main_image"), $main_image);
        //rename image and upload  

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
        ));

        //   insert other images into db start
        if (isset($data['image_one'])) {
            $image_one = time() . rand(1, 1000) . '.' . $data['image_one']->extension();
            $data['image_one']->move(public_path("ad_image/sub_images"), $image_one); //rename image and upload public
            DB::table('ads_image')->insert([array(
                'image_name' => $image_one,
                'ads_id' => $last_inerted_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )]);
        }
        if (isset($data['image_two'])) {
            $image_two = time() . rand(1, 1000) . '.' . $data['image_two']->extension();
            $data['image_two']->move(public_path("ad_image/sub_images"), $image_two); //rename image and upload public
            DB::table('ads_image')->insert([array(
                'image_name' => $image_two,
                'ads_id' => $last_inerted_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )]);
        }
        if (isset($data['image_three'])) {
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
            return response()->json(['code' => 'true', 'msg' => 'Ad Created ', 'last_inerted_id' => $last_inerted_id, 'payment_method' => $data['payment_method']]);
        } else {
            return response()->json(['code' => 'false', 'msg' => 'Something Went Wrong !']);
        }
    }

    public function create_electronic(array $data)
    {
        // //deal with main image
        $main_image = time() . rand(1, 1000) . '.' . $data['main_image']->extension();
        $data['main_image']->move(public_path("ad_image/main_image"), $main_image);
        //rename image and upload  

        //create post start
        // if ads_type null assign it a default value(0) or not null get its name 
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
        ));

        // //rename and move sub images
        $image_one = time() . rand(1, 1000) . '.' . $data['image_one']->extension();
        $data['image_one']->move(public_path("ad_image/sub_images"), $image_one); //rename image and upload 

        $image_two = time() . rand(1, 1000) . '.' . $data['image_two']->extension();
        $data['image_two']->move(public_path("ad_image/sub_images"), $image_two); //rename image and upload 

        $image_three = time() . rand(1, 1000) . '.' . $data['image_three']->extension();
        $data['image_three']->move(public_path("ad_image/sub_images"), $image_three); //rename image and upload 

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
        $model_default = '';
        $type_default = '';
        if (isset($data['model'])) {
            $model_default = $data['model'];
        } else {
            $model_default = 1;  //this default values because we cant pass null values to forign ids  
        }
        if (isset($data['type'])) {
            $type_default =  $data['type'];
        } else {
            $type_default = 1; //this default values because we cant pass null values to forign ids
        }

        $data_insert = [
            'ele_condition' => $data['condition'] ?? null,
            'ads_id' => $last_inerted_id,
            'brands_id' => $data['brand'] ?? null,
            'models_id' => $model_default,
            'ele_edition' => $data['edition'] ?? null,
            'ele_price_negotiable' => $data['negotiable'] ?? null,
            'sub_catgeory_types_id' => $type_default,
            'elec_screen_size' => $data['screen_size'] ?? null,
            'elec_capacity' => $data['capacity'] ?? null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        //start  create electronic table data 
        $electronic_last_inserted = DB::table('electronics')->insertGetId($data_insert);
        //end  create electronic table data 


        //send features data when subcategory is mobile phone
        if (isset($data['4G'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['4G']]));
        }

        if (isset($data['5G'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['5G']]));
        }

        if (isset($data['Dual_SIM'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Dual_SIM']]));
        }
        if (isset($data['Micro_SIM'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Micro_SIM']]));
        }
        if (isset($data['Mini_SIM'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Mini_SIM']]));
        }
        if (isset($data['USB_Type-B_Port'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['USB_Type-B_Port']]));
        }
        if (isset($data['USB_Type-C_Port'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['USB_Type-C_Port']]));
        }
        if (isset($data['Fast_Charging'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Fast_Charging']]));
        }
        if (isset($data['Flash_Charging'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Flash_Charging']]));
        }
        if (isset($data['Android'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Android']]));
        }
        if (isset($data['Windows'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Windows']]));
        }
        if (isset($data['iOS'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['iOS']]));
        }
        if (isset($data['Expandable_Memory'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Expandable_Memory']]));
        }
        if (isset($data['4_GB_RAM'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['4_GB_RAM']]));
        }
        if (isset($data['6_GB_RAM'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['6_GB_RAM']]));
        }
        if (isset($data['8_GB_RAM'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['8_GB_RAM']]));
        }
        if (isset($data['12_GB_RAM'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['12_GB_RAM']]));
        }
        if (isset($data['Dual_Camera'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Dual_Camera']])); //
        }
        if (isset($data['Triple_Camera'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Triple_Camera']]));
        }
        if (isset($data['Dual_LED_Flash'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Dual_LED_Flash']]));
        }
        if (isset($data['Quad_LED_Flash'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Quad_LED_Flash']]));
        }
        if (isset($data['Bluetooth'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Bluetooth']]));
        }
        if (isset($data['Wifi'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Wifi']]));
        }
        if (isset($data['GPS'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['GPS']]));
        }
        if (isset($data['Fingerprint_Sensor'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Fingerprint_Sensor']]));
        }
        if (isset($data['Infrared_port'])) {
            DB::table('features')->insert(array(['electronic_id' => $electronic_last_inserted, 'feature_name' => $data['Infrared_port']])); //
        }

        // send success message 
        if ($electronic_last_inserted) {
            // check is this free ads or payed
            $key = Session::get('vendorLogin');
            DB::table('users')
                ->where('key', $key)
                ->where('free', '>', 0) // Check if 'free' is greater than 0
                ->decrement('free', 1);
            return response()->json(['code' => 'true', 'msg' => 'Ad Created ', 'last_inerted_id' => $last_inerted_id, 'payment_method' => $data['payment_method']]);
        } else {
            return response()->json(['code' => 'false', 'msg' => 'Something Went Wrong !']);
        }
    }

    public function create_vehicle(array $data)
    {
        //deal with main image
        $main_image = time() . rand(1, 1000) . '.' . $data['main_image']->extension();
        $data['main_image']->move(public_path("ad_image/main_image"), $main_image);
        //rename image and upload  

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
        ));


        // //rename and move sub images
        $image_one = time() . rand(1, 1000) . '.' . $data['image_one']->extension();
        $data['image_one']->move(public_path("ad_image/sub_images"), $image_one); //rename image and upload 

        $image_two = time() . rand(1, 1000) . '.' . $data['image_two']->extension();
        $data['image_two']->move(public_path("ad_image/sub_images"), $image_two); //rename image and upload 

        $image_three = time() . rand(1, 1000) . '.' . $data['image_three']->extension();
        $data['image_three']->move(public_path("ad_image/sub_images"), $image_three); //rename image and upload 

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
            return response()->json(['code' => 'true', 'msg' => 'Ad Created ', 'last_inerted_id' => $last_inerted_id, 'payment_method' => $data['payment_method']]);
        } else {
            return response()->json(['code' => 'false', 'msg' => 'Something Went Wrong !']);
        }
    }
    public function create_education(array $data)
    {
        //deal with main image
        $main_image = time() . rand(1, 1000) . '.' . $data['main_image']->extension();
        $data['main_image']->move(public_path("ad_image/main_image"), $main_image);
        //rename image and upload  

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
        ));

        //   insert other images into db start
        if (isset($data['image_one'])) {
            $image_one = time() . rand(1, 1000) . '.' . $data['image_one']->extension();
            $data['image_one']->move(public_path("ad_image/sub_images"), $image_one); //rename image and upload public
            DB::table('ads_image')->insert([array(
                'image_name' => $image_one,
                'ads_id' => $last_inerted_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )]);
        }
        if (isset($data['image_two'])) {
            $image_two = time() . rand(1, 1000) . '.' . $data['image_two']->extension();
            $data['image_two']->move(public_path("ad_image/sub_images"), $image_two); //rename image and upload public
            DB::table('ads_image')->insert([array(
                'image_name' => $image_two,
                'ads_id' => $last_inerted_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )]);
        }
        if (isset($data['image_three'])) {
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
            return response()->json(['code' => 'true', 'msg' => 'Ad Created ', 'last_inerted_id' => $last_inerted_id, 'payment_method' => $data['payment_method']]);
        } else {
            return response()->json(['code' => 'false', 'msg' => 'Something Went Wrong !']);
        }
    }
    public function create_jobs(array $data)
    {
        //deal with main image
        $main_image = time() . rand(1, 1000) . '.' . $data['main_image']->extension();
        $data['main_image']->move(public_path("ad_image/main_image"), $main_image);
        //rename image and upload  

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
        ));

        //   insert other images into db start
        if (isset($data['image_one'])) {
            $image_one = time() . rand(1, 1000) . '.' . $data['image_one']->extension();
            $data['image_one']->move(public_path("ad_image/sub_images"), $image_one); //rename image and upload public
            DB::table('ads_image')->insert([array(
                'image_name' => $image_one,
                'ads_id' => $last_inerted_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )]);
        }
        if (isset($data['image_two'])) {
            $image_two = time() . rand(1, 1000) . '.' . $data['image_two']->extension();
            $data['image_two']->move(public_path("ad_image/sub_images"), $image_two); //rename image and upload public
            DB::table('ads_image')->insert([array(
                'image_name' => $image_two,
                'ads_id' => $last_inerted_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )]);
        }
        if (isset($data['image_three'])) {
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
            return response()->json(['code' => 'true', 'msg' => 'Ad Created ', 'last_inerted_id' => $last_inerted_id, 'payment_method' => $data['payment_method']]);
        } else {
            return response()->json(['code' => 'false', 'msg' => 'Something Went Wrong !']);
        }
    }
    public function create_service(array $data)
    {
        //deal with main image
        $main_image = time() . rand(1, 1000) . '.' . $data['main_image']->extension();
        $data['main_image']->move(public_path("ad_image/main_image"), $main_image);
        //rename image and upload  

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
        ));

        //   insert other images into db start
        if (isset($data['image_one'])) {
            $image_one = time() . rand(1, 1000) . '.' . $data['image_one']->extension();
            $data['image_one']->move(public_path("ad_image/sub_images"), $image_one); //rename image and upload public
            DB::table('ads_image')->insert([array(
                'image_name' => $image_one,
                'ads_id' => $last_inerted_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )]);
        }
        if (isset($data['image_two'])) {
            $image_two = time() . rand(1, 1000) . '.' . $data['image_two']->extension();
            $data['image_two']->move(public_path("ad_image/sub_images"), $image_two); //rename image and upload public
            DB::table('ads_image')->insert([array(
                'image_name' => $image_two,
                'ads_id' => $last_inerted_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            )]);
        }
        if (isset($data['image_three'])) {
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
            return response()->json(['code' => 'true', 'msg' => 'Ad Created ', 'last_inerted_id' => $last_inerted_id, 'payment_method' => $data['payment_method']]);
        } else {
            return response()->json(['code' => 'false', 'msg' => 'Something Went Wrong !']);
        }
    }
}
