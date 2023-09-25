<?php

namespace App\Http\Controllers\web;

use App\Contracts\AdsInterface;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\packages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdController extends Controller
{
    public $ads;
    function __construct(AdsInterface $ads)
    {
        $this->ads = $ads;
    }

    // *** start create property catgeory
    public function create_property(Request $request)
    {

        $request->validate([  //validation
            'ads_location' => 'required',
            'ads_sublocation' => 'required',
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'main_image' => 'required|image|max:500',
            'image_one' => 'image|max:500',
            'image_two' => 'image|max:500',
            'image_three' => 'image|max:500',
            'address' => 'required',

            'bedrooms' => 'required_if:sub_category_id,49|required_if:sub_category_id,50',
            'bathrooms' => 'required_if:sub_category_id,49|required_if:sub_category_id,50',
            'house_size' => 'required_if:sub_category_id,49|required_if:sub_category_id,50|numeric',
            'land_type' => 'required_if:sub_category_id,48',

            'landSize' => 'required_if:sub_category_id,48|required_if:sub_category_id,49|numeric',
            'unit_price' => 'required_if:sub_category_id,48|numeric',
        ], [
            'bedrooms.required_if' => 'bedrooms is required',
            'bathrooms.required_if' => 'bathrooms is required',
            'house_size.required_if' => 'house size field is required',
            'land_type.required_if' => 'land type is required',
            'landSize.required_if' => 'land size is required',
            'unit_price.required_if' => 'unit price is required',
        ]);
        // check is this free ads or payed
        $key = Session::get('vendorLogin');
        $current_free_ads = DB::table('users')->where('key', $key)->pluck('free')->first();
        if ($current_free_ads > 0) { // free ad
            $request->merge([
                'payment_method' => 'free',
            ]);
            $data = $this->ads->create_property($request->all());
            return $data;
        } else { // payed ad

            $main_image = null;
            $image_one = null;
            $image_two = null;
            $image_three = null;

            if ($request->hasFile('main_image')) {
                $main_image = time() . rand(1, 1000) . '.' . $request->main_image->extension();
                $request->main_image->move(public_path("temp_ad_images/"), $main_image); //rename image and upload
            }

            if ($request->hasFile('image_one')) {
                $image_one = time() . rand(1, 1000) . '.' . $request->image_one->extension();
                $request->image_one->move(public_path("temp_ad_images/"), $image_one); //rename image and upload
            }

            if ($request->hasFile('image_two')) {
                $image_two = time() . rand(1, 1000) . '.' . $request->image_two->extension();
                $request->image_two->move(public_path("temp_ad_images/"), $image_two); //rename image and upload
            }

            if ($request->hasFile('image_three')) {
                $image_three = time() . rand(1, 1000) . '.' . $request->image_three->extension();
                $request->image_three->move(public_path("temp_ad_images/"), $image_three); //rename image and upload
            }

            // Create a response array including the message and the request data
            $response = [
                'payment_method' => 'payed',
                'category' => 'property',
                'request_data' => $request->all(),
                'main_image' => $main_image,
                'image_one' => $image_one,
                'image_two' => $image_two,
                'image_three' => $image_three,
            ];
            // Encode the response data as JSON
            $responseDataJson = json_encode($response);

            // Remove the 'tempartPayAdsData' item from the session
            Session::forget('tempartPayAdsData');
            // Store the JSON-encoded response data in the session
            Session::put('tempartPayAdsData', $responseDataJson);

            return response()->json($response);
        }
    }
    // *** end create property catgeory

    // *** start create electronic catgeory
    public function create_electronic(Request $request)
    {

        $request->validate([
            'ads_location' => 'required',
            'ads_sublocation' => 'required',
            'title' => 'required',
            'description' => 'required',
            'type' => 'required_if:sub_category_id,5|required_if:sub_category_id,3|required_if:sub_category_id,4|required_if:sub_category_id,11|required_if:sub_category_id,12|required_if:sub_category_id,9|required_if:sub_category_id,7|required_if:sub_category_id,6|required_if:sub_category_id,10|required_if:sub_category_id,13',
            'price' => 'required|numeric',
            'main_image' => 'required|image|max:500',
            'brand' => 'required',
            'model' => 'required_if:sub_category_id,2|required_if:sub_category_id,3|required_if:sub_category_id,11',
            'capacity' => 'required_if:sub_category_id,10',
            'screen_size' => 'required_if:sub_category_id,11',
            'image_one' => 'required|image|max:500',
            'image_two' => 'required|image|max:500',
            'image_three' => 'required|image|max:500',
        ], [
            'type.required_if' => 'type field is required',
            'model.required_if' => 'model field is required',
            'edition.required_if' => 'edition field is required',
            'capacity.required_if' => 'capacity field is required',
            'screen_size.required_if' => 'screen_size field is required',
        ]);

        // new code 
        $key = Session::get('vendorLogin');
        $current_free_ads = DB::table('users')->where('key', $key)->pluck('free')->first();

        if ($current_free_ads > 0) { // free ad
            $request->merge([
                'payment_method' => 'free',
            ]);
            $data = $this->ads->create_electronic($request->all());
            return $data;
        } else {
            // payed ad

            $main_image = null;
            $image_one = null;
            $image_two = null;
            $image_three = null;

            if ($request->hasFile('main_image')) {
                $main_image = time() . rand(1, 1000) . '.' . $request->main_image->extension();
                $request->main_image->move(public_path("temp_ad_images/"), $main_image); //rename image and upload
            }

            if ($request->hasFile('image_one')) {
                $image_one = time() . rand(1, 1000) . '.' . $request->image_one->extension();
                $request->image_one->move(public_path("temp_ad_images/"), $image_one); //rename image and upload
            }

            if ($request->hasFile('image_two')) {
                $image_two = time() . rand(1, 1000) . '.' . $request->image_two->extension();
                $request->image_two->move(public_path("temp_ad_images/"), $image_two); //rename image and upload
            }

            if ($request->hasFile('image_three')) {
                $image_three = time() . rand(1, 1000) . '.' . $request->image_three->extension();
                $request->image_three->move(public_path("temp_ad_images/"), $image_three); //rename image and upload
            }

            // Create a response array including the message and the request data
            $response = [
                'payment_method' => 'payed',
                'category' => 'electronic',
                'request_data' => $request->all(),
                'main_image' => $main_image,
                'image_one' => $image_one,
                'image_two' => $image_two,
                'image_three' => $image_three,
            ];

            // Encode the response data as JSON
            $responseDataJson = json_encode($response);

            // Remove the 'tempartPayAdsData' item from the session
            Session::forget('tempartPayAdsData');
            // Store the JSON-encoded response data in the session
            Session::put('tempartPayAdsData', $responseDataJson);

            return response()->json($response);
        }
    }
    // *** end electronic category

    // *** start vehicle category 
    public function create_vehicle(Request $request)
    {

        $request->validate([
            'title' => 'required|max:60',
            'brand' => 'required_if:sub_category_id,17|required_if:sub_category_id,16|required_if:sub_category_id,19|required_if:sub_category_id,20|required_if:sub_category_id,22|required_if:sub_category_id,26|required_if:sub_category_id,21|required_if:sub_category_id,25|required_if:sub_category_id,24|required_if:sub_category_id,15|',
            'price' => 'required|numeric|max:9999999999999.99',

            'Edition' => 'max:60', //need to add

            'Mileage' => 'numeric|required_if:sub_category_id,16| required_if:sub_category_id,17| required_if:sub_category_id,19| required_if:sub_category_id,21| required_if:sub_category_id,22|max:999999999999999',
            'fuel_type' => 'required_if:sub_category_id,17',

            'Bodytype' => 'required_if:sub_category_id,17',
            'VehicleType' => 'required_if:sub_category_id,16|required_if:sub_category_id,25|required_if:sub_category_id,18|required_if:sub_category_id,23|required_if:sub_category_id,15',
            'Condition' => 'required_if:sub_category_id,16|required_if:sub_category_id,17|required_if:sub_category_id,19|required_if:sub_category_id,20|required_if:sub_category_id,21|required_if:sub_category_id,22|required_if:sub_category_id,24|required_if:sub_category_id,25|required_if:sub_category_id,26|required_if:sub_category_id,27',

            'YearOfManufacture' => 'numeric|digits:4|required_if:sub_category_id,16|required_if:sub_category_id,17|required_if:sub_category_id,19|required_if:sub_category_id,21|required_if:sub_category_id,22|required_if:sub_category_id,24|required_if:sub_category_id,25|required_if:sub_category_id,26|',
            'model' => 'required_if:sub_category_id,17|required_if:sub_category_id,16|required_if:sub_category_id,19|required_if:sub_category_id,22|required_if:sub_category_id,26|required_if:sub_category_id,21|required_if:sub_category_id,25|required_if:sub_category_id,24|',
            'Enginecapacity' => 'numeric|required_if:sub_category_id,16|required_if:sub_category_id,17|required_if:sub_category_id,21|required_if:sub_category_id,22|required_if:sub_category_id,26|max:999999999999999',

            'Transmission' => 'required_if:sub_category_id,17',
            'negotiable' => 'required',
            'main_image' => 'required|image|max:500',

            'image_one' => 'required|image|max:500',
            'image_two' => 'required|image|max:500',
            'image_three' => 'required|image|max:500',
            'description' => 'required',
        ], [
            'Mileage.numeric' => 'Mileage should be number. ',
            'Mileage.required_if' => 'Mileage field is required. ',
            'YearOfManufacture.numeric' => 'Year Of Manufacture should be number. ',
            'Enginecapacity.numeric' => 'Engine capacity should be number. ',
            'brand.required_if' => 'brand field is required. ',
            'VehicleType.required_if' => 'Vehicle Type field is required. ',
            'model.required_if' => 'Vehicle model field is required. ',
            'Transmission.required_if' => 'Transmission field is required. ',
            'fuel_type.required_if' => 'Fuel type field is required. ',
            'Bodytype.required_if' => 'Body type field is required. ',
            'Condition.required_if' => 'Condition field is required. ',
            'Enginecapacity.required_if' => 'Engine capacity field is required. ',
            'YearOfManufacture.required_if' => 'Year of manufacture field is required. ',
            'Edition.required_if' => 'Edition field is required. ',
        ]);

        // new code 
        $key = Session::get('vendorLogin');
        $current_free_ads = DB::table('users')->where('key', $key)->pluck('free')->first();

        if ($current_free_ads > 0) { // free ad
            $request->merge([
                'payment_method' => 'free',
            ]);

            $data = $this->ads->create_vehicle($request->all());
            return $data;
        } else {
            // payed ad

            $main_image = null;
            $image_one = null;
            $image_two = null;
            $image_three = null;

            if ($request->hasFile('main_image')) {
                $main_image = time() . rand(1, 1000) . '.' . $request->main_image->extension();
                $request->main_image->move(public_path("temp_ad_images/"), $main_image); //rename image and upload
            }

            if ($request->hasFile('image_one')) {
                $image_one = time() . rand(1, 1000) . '.' . $request->image_one->extension();
                $request->image_one->move(public_path("temp_ad_images/"), $image_one); //rename image and upload
            }

            if ($request->hasFile('image_two')) {
                $image_two = time() . rand(1, 1000) . '.' . $request->image_two->extension();
                $request->image_two->move(public_path("temp_ad_images/"), $image_two); //rename image and upload
            }

            if ($request->hasFile('image_three')) {
                $image_three = time() . rand(1, 1000) . '.' . $request->image_three->extension();
                $request->image_three->move(public_path("temp_ad_images/"), $image_three); //rename image and upload
            }

            // Create a response array including the message and the request data
            $response = [
                'payment_method' => 'payed',
                'category' => 'vehicle',
                'request_data' => $request->all(),
                'main_image' => $main_image,
                'image_one' => $image_one,
                'image_two' => $image_two,
                'image_three' => $image_three,
            ];

            // Encode the response data as JSON
            $responseDataJson = json_encode($response);
            // Remove the 'tempartPayAdsData' item from the session
            Session::forget('tempartPayAdsData');
            // Store the JSON-encoded response data in the session
            Session::put('tempartPayAdsData', $responseDataJson);
            return response()->json($response);
        }
        // new code 

    }
    // *** end vehicle category 

    // *** start education category 
    public function create_education(Request $request)
    {
        $request->validate([
            'ads_location' => 'required',
            'ads_sublocation' => 'required',
            'title' => 'required|max:60',
            'price' => 'required|max:9999999999999.99|numeric',
            'educationType' => 'required_if:sub_category_id,29|required_if:sub_category_id,30|',
            'description' => 'required|max:3000',
            'main_image' => 'required|image|max:500', // not required
            'image_one' => 'image|max:500', //not required
            'image_two' => 'image|max:500', //not required
            'image_three' => 'image|max:500', //not required
            'negotiable' => 'required',
            'Condition' => 'required_if:sub_category_id,29'
        ], [
            'educationType.required_if' => 'Type field is required. ',
            'Condition.required_if' => 'Condition field is required. ',
        ]);

        // new code 
        $key = Session::get('vendorLogin');
        $current_free_ads = DB::table('users')->where('key', $key)->pluck('free')->first();

        if ($current_free_ads > 0) { // free ad
            $request->merge([
                'payment_method' => 'free',
            ]);

            $data = $this->ads->create_education($request->all());
            return $data;
        } else {
            // payed ad

            $main_image = null;
            $image_one = null;
            $image_two = null;
            $image_three = null;

            if ($request->hasFile('main_image')) {
                $main_image = time() . rand(1, 1000) . '.' . $request->main_image->extension();
                $request->main_image->move(public_path("temp_ad_images/"), $main_image); //rename image and upload
            }

            if ($request->hasFile('image_one')) {
                $image_one = time() . rand(1, 1000) . '.' . $request->image_one->extension();
                $request->image_one->move(public_path("temp_ad_images/"), $image_one); //rename image and upload
            }

            if ($request->hasFile('image_two')) {
                $image_two = time() . rand(1, 1000) . '.' . $request->image_two->extension();
                $request->image_two->move(public_path("temp_ad_images/"), $image_two); //rename image and upload
            }

            if ($request->hasFile('image_three')) {
                $image_three = time() . rand(1, 1000) . '.' . $request->image_three->extension();
                $request->image_three->move(public_path("temp_ad_images/"), $image_three); //rename image and upload
            }

            // Create a response array including the message and the request data
            $response = [
                'payment_method' => 'payed',
                'category' => 'education',
                'request_data' => $request->all(),
                'main_image' => $main_image,
                'image_one' => $image_one,
                'image_two' => $image_two,
                'image_three' => $image_three,
            ];

            // Encode the response data as JSON
            $responseDataJson = json_encode($response);
            // Remove the 'tempartPayAdsData' item from the session
            Session::forget('tempartPayAdsData');
            // Store the JSON-encoded response data in the session
            Session::put('tempartPayAdsData', $responseDataJson);
            return response()->json($response);
        }
        // new code 
    }
    // *** end education category 

    public function create_jobs(Request $request)
    { //create jobs ad
        $request->validate([
            'ads_location' => 'required',
            'ads_sublocation' => 'required',
            'title' => 'required|max:100',
            'price' => 'required|max:9999999999999.99|integer',
            'jobType' => 'required',
            'job_work_expirience' => 'required|max:100',
            'job_education' => 'required',
            'jobs_application_deadline' => 'required',
            'sallary_start_to' => 'required',
            'sallary_start_from' => 'required',
            'job_employer' => 'required',
            'job_employer_website' => 'url',
            'description' => 'required',
            'main_image' => 'required|image|max:500', // not required
            'image_one' => 'image|max:500', //not required
            'image_two' => 'image|max:500', //not required
            'image_three' => 'image|max:500', //not required
        ]);

        // new code 
        $key = Session::get('vendorLogin');
        $current_free_ads = DB::table('users')->where('key', $key)->pluck('free')->first();

        if ($current_free_ads > 0) { // free ad
            $request->merge([
                'payment_method' => 'free',
            ]);
            $data = $this->ads->create_jobs($request->all());
            return $data;
        } else {
            // payed ad
            $main_image = null;
            $image_one = null;
            $image_two = null;
            $image_three = null;

            if ($request->hasFile('main_image')) {
                $main_image = time() . rand(1, 1000) . '.' . $request->main_image->extension();
                $request->main_image->move(public_path("temp_ad_images/"), $main_image); //rename image and upload
            }

            if ($request->hasFile('image_one')) {
                $image_one = time() . rand(1, 1000) . '.' . $request->image_one->extension();
                $request->image_one->move(public_path("temp_ad_images/"), $image_one); //rename image and upload
            }

            if ($request->hasFile('image_two')) {
                $image_two = time() . rand(1, 1000) . '.' . $request->image_two->extension();
                $request->image_two->move(public_path("temp_ad_images/"), $image_two); //rename image and upload
            }

            if ($request->hasFile('image_three')) {
                $image_three = time() . rand(1, 1000) . '.' . $request->image_three->extension();
                $request->image_three->move(public_path("temp_ad_images/"), $image_three); //rename image and upload
            }

            // Create a response array including the message and the request data
            $response = [
                'category' => 'jobs',
                'payment_method' => 'payed',
                'request_data' => $request->all(),
                'main_image' => $main_image,
                'image_one' => $image_one,
                'image_two' => $image_two,
                'image_three' => $image_three,
            ];

            // Encode the response data as JSON
            $responseDataJson = json_encode($response);

            // Remove the 'tempartPayAdsData' item from the session
            Session::forget('tempartPayAdsData');
            // Store the JSON-encoded response data in the session
            Session::put('tempartPayAdsData', $responseDataJson);

            return response()->json($response);
        }
    }

    public function create_service(Request $request)
    {
        $request->validate([
            'ads_location' => 'required',
            'ads_sublocation' => 'required',
            'description' => 'required|max:3000',
            'price' => 'required|max:9999999999999.99|integer',
            'title' => 'required|max:60',
            'main_image' => 'required|image|max:500', // not required
            'image_one' => 'image|max:500', //not required
            'image_two' => 'image|max:500', //not required
            'image_three' => 'image|max:500', //not required
            'negotiable' => 'required',
            'serviceType' => 'required'
        ]);

        // new code 
        $key = Session::get('vendorLogin');
        $current_free_ads = DB::table('users')->where('key', $key)->pluck('free')->first();

        if ($current_free_ads > 0) { // free ad
            $request->merge([
                'payment_method' => 'free',
            ]);
            $data = $this->ads->create_service($request->all());
            return $data;
        } else {
            // payed ad
            $main_image = null;
            $image_one = null;
            $image_two = null;
            $image_three = null;

            if ($request->hasFile('main_image')) {
                $main_image = time() . rand(1, 1000) . '.' . $request->main_image->extension();
                $request->main_image->move(public_path("temp_ad_images/"), $main_image); //rename image and upload
            }

            if ($request->hasFile('image_one')) {
                $image_one = time() . rand(1, 1000) . '.' . $request->image_one->extension();
                $request->image_one->move(public_path("temp_ad_images/"), $image_one); //rename image and upload
            }

            if ($request->hasFile('image_two')) {
                $image_two = time() . rand(1, 1000) . '.' . $request->image_two->extension();
                $request->image_two->move(public_path("temp_ad_images/"), $image_two); //rename image and upload
            }

            if ($request->hasFile('image_three')) {
                $image_three = time() . rand(1, 1000) . '.' . $request->image_three->extension();
                $request->image_three->move(public_path("temp_ad_images/"), $image_three); //rename image and upload
            }

            // Store only the necessary information in the session
            $response = [
                'payment_method' => 'payed',
                'category' => 'service',
                'request_data' => $request->all(),
                'main_image' => $main_image,
                'image_one' => $image_one,
                'image_two' => $image_two,
                'image_three' => $image_three,
            ];

            // Encode the response data as JSON
            $responseDataJson = json_encode($response);

            // Remove the 'tempartPayAdsData' item from the session
            Session::forget('tempartPayAdsData');
            // Store the JSON-encoded response data in the session
            Session::put('tempartPayAdsData', $responseDataJson);
            return response()->json($response);
        }
    }

    public function ads_type_for_free_ads($inserted_ad)
    {
        $packages = packages::where('status', 1)
            ->with('getAdsTypes') // Eager load the getAdsTypes relationship
            ->get();

        $current_ad = DB::table('ads')->where('id', $inserted_ad)->first(); // get last inserted ad    
        return view('web.useAdsTypes.freeAds', compact('inserted_ad', 'packages', 'current_ad'));
    }

    public function ads_type_for_payed_ads(Request $request)
    {
        $data = json_decode($request->data, true); // Decoding as an associative array
        $packages = packages::where('status', 1)
            ->with('getAdsTypes') // Eager load the getAdsTypes relationship
            ->get();
        return view('web.useAdsTypes.payedAds', compact('data', 'packages'));
    }
}
