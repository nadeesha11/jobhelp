<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\subCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class vendorDashBoardController extends Controller
{
  public function index($key)
  {

    $key =  Session::get('vendorLogin');
    $user_data = User::where('key', $key)->first();

    // get category and sub cat data
    $category =  category::where('status', 1)->get();
    unset($category[0]); //remove default value

    $dirstrict = DB::table('districts')->get();
    return view('web.vendor_dashboard.vendorDashboard', compact(['category', 'dirstrict', 'user_data']));
  }

  public function getSubCategory($id)
  {

    $subCategory = subCategory::where('cat_id', $id)->get();
    return json_encode($subCategory);
  }

  public function createPost($id)
  {
    $result = subCategory::where('id', $id)->pluck('cat_id')->first();

    if ($result == 2) { // this is electronic category
      $category = category::where('id', $result)->first();
      $subCategory = subCategory::where('id', $id)->first(); //get selected category sub catgeory data
      // get user key 
      $key = Session::get('vendorLogin');
      $userData = DB::table('users')->where('key', $key)->first();

      // get all locations 
      $locations = DB::table('districts')->get();
      $subCategoryTypes = DB::table('sub_category_types')->where('sub_cat_id', $subCategory->id)->get();  //sub cat Types 
      $subCatBrands = DB::table('subcategory_brands')->where('sub_cat_id', $subCategory->id)->where('status', 1)->get();   //get sub cat brands

      return view('web.create ads.electronics', compact(['locations', 'userData', 'subCategory', 'category', 'subCategoryTypes', 'subCatBrands']));
    } else if ($result == 3) { // this is vehicle catgeory

      $category = category::where('id', $result)->first();
      $subCategory = subCategory::where('id', $id)->first(); //get selected category sub catgeory data
      // get user key 
      $key = Session::get('vendorLogin');
      $userData = DB::table('users')->where('key', $key)->first();

      // get all locations 
      $locations = DB::table('districts')->get();
      $subCategoryTypes = DB::table('sub_category_types')->where('sub_cat_id', $subCategory->id)->get();  //sub cat Types 
      $subCatBrands = DB::table('subcategory_brands')->where('sub_cat_id', $subCategory->id)->where('status', 1)->get();   //get sub cat brands
      return view('web.create ads.vehicle', compact(['locations', 'userData', 'subCategory', 'category', 'subCategoryTypes', 'subCatBrands'])); // return view vehicle
    } else if ($result == 7) { // this is education catgeory

      $category = category::where('id', $result)->first();
      $subCategory = subCategory::where('id', $id)->first(); //get selected category sub catgeory data
      // get user key 
      $key = Session::get('vendorLogin');
      $userData = DB::table('users')->where('key', $key)->first();

      // get all locations 
      $locations = DB::table('districts')->get();
      $subCategoryTypes = DB::table('sub_category_types')->where('sub_cat_id', $subCategory->id)->get();  //sub cat Types 
      $subCatBrands = DB::table('subcategory_brands')->where('sub_cat_id', $subCategory->id)->where('status', 1)->get();   //get sub cat brands
      return view('web.create ads.education', compact(['locations', 'userData', 'subCategory', 'category', 'subCategoryTypes', 'subCatBrands'])); // return view vehicle
    } else if ($result == 5) { // this is Services catgeory

      $category = category::where('id', $result)->first();
      $subCategory = subCategory::where('id', $id)->first(); //get selected category sub catgeory data
      // get user key 
      $key = Session::get('vendorLogin');
      $userData = DB::table('users')->where('key', $key)->first();

      // get all locations 
      $locations = DB::table('districts')->get();
      $subCategoryTypes = DB::table('sub_category_types')->where('sub_cat_id', $subCategory->id)->get();  //sub cat Types 
      $subCatBrands = DB::table('subcategory_brands')->where('sub_cat_id', $subCategory->id)->where('status', 1)->get();   //get sub cat brands
      return view('web.create ads.services', compact(['locations', 'userData', 'subCategory', 'category', 'subCategoryTypes', 'subCatBrands'])); // return view services
    } else if ($result == 6) { // this is jobs category

      $category = category::where('id', $result)->first();
      $subCategory = subCategory::where('id', $id)->first(); //get selected category sub catgeory data
      // get user key 
      $key = Session::get('vendorLogin');
      $userData = DB::table('users')->where('key', $key)->first();

      // get all locations 
      $locations = DB::table('districts')->get();

      return view('web.create ads.jobs', compact(['locations', 'userData', 'subCategory', 'category',])); // return view jobs
    } else if ($result == 4) { // this is property category

      $category = category::where('id', $result)->first();
      $subCategory = subCategory::where('id', $id)->first(); //get selected category sub catgeory data
      // get user key 
      $key = Session::get('vendorLogin');
      $userData = DB::table('users')->where('key', $key)->first();

      // get all locations 
      $locations = DB::table('districts')->get();

      return view('web.create ads.property', compact(['locations', 'userData', 'subCategory', 'category'])); // return view jobs
    }
  }

  public function getSubLocation($selectedlocation)
  {

    $sublocation = DB::table('cities')->where('district_id', $selectedlocation)->get();
    // return json_encode($sublocation);
    return response()->json(['sublocation' => $sublocation]);
  }

  public function update(Request $request)
  {

    $request->validate([
      'email' => 'email:rfc,dns|required|max:45',
      'first_name' => 'required|max:40',
      'last_name' => 'required|max:40',
      // 'location'=>'required',
      // 'sub_location'=>'required',
      'phone_number' => 'required|digits:9'

    ]);

    $phone_number = "+94" . $request->phone_number;  // make phone number as international version 
    $location = DB::table('districts')->where('id', $request->location)->pluck('name_en')->first();
    $sub_location = DB::table('cities')->where('id', $request->sub_location)->pluck('name_en')->first();

    $key =  Session::get('vendorLogin');
    $user_id = User::where('key', $key)->pluck('id')->first();

    $update = User::find($user_id);
    $update->email = $request->email;
    $update->first_name = $request->first_name;
    $update->last_name = $request->last_name;
    if ($request->location) {
      $update->location = $location;
    }
    if ($request->sub_location) {
      $update->sub_location = $sub_location;
    }

    $update->phone_number = $phone_number;

    $result = $update->save();
    if ($result) {
      return response()->json(['code' => 'true', 'msg' => 'Account details updated', 'location' => $location, 'sublocation' => $sub_location]);
    } else {
      return response()->json(['code' => 'false', 'msg' => 'Something went wrong !!!']);
    }
  }

  public function getModels($brand)
  {

    // return $brand;
    $models = DB::table('brandmodel')->where('brand_id', $brand)->get();
    return response()->json(['models' => $models]);
  }
}
