<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class subCategoryController extends Controller
{
  public function index($id)
  {

    return view('adminPanel.subcategory.index', compact('id'));
  }

  public function create(Request $request)
  {

    $request->validate([
      'sub_category_name' => 'required|max:40',
      'sub_category_description' => 'required|max:250',

    ]);

    $subcategory = new subCategory;
    $subcategory->sub_cat_name = $request->sub_category_name;
    $subcategory->sub_cat_description = $request->sub_category_description;
    $subcategory->status = 1;
    $subcategory->cat_id = $request->id;
    $result =  $subcategory->save(); //create subcategory

    if ($result) {

      return response()->json(['code' => 'true', 'msg' => 'Category created']);
    } else {

      return response()->json(['code' => 'false', 'msg' => 'Something went wrong']);
    }
  }

  public function getData($id)
  {

    $data =  DB::table('subcategory')->where('cat_id', $id)->get();

    return datatables()->of($data)
      ->addIndexColumn()
      ->addColumn('more', function ($data) {

        $btn = '<a  href="javascript:void(0)"   data-id="' . $data->id . '" class="more btn btn-link btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
        return $btn;
      })
      ->addColumn('action', function ($data) {
        $btn = '<a  href="javascript:void(0)"   data-id="' . $data->id . '" class="edit_sub_category btn btn-warning btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
        $btn = $btn . '<a  href="javascript:void(0)" data-id="' . $data->id . '" class="delete_sub_category btn btn-danger btn-sm"><i class="ik ik-trash-2"></i></a>';
        return $btn;
      })
      ->addColumn('status', function ($data) {
        if ($data->status == 1) {
          $status = '<span class="badge badge-pill badge-success mb-1">Active</span>';
        } else {
          $status = '<span class="badge badge-pill badge-danger mb-1">Inactive</span>';
        }
        return $status;
      })
      ->addColumn('brands', function ($data) {

        $btn = '<a  href="javascript:void(0)"   data-id="' . $data->id . '" class="brands btn btn-link btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
        return $btn;
      })
      ->addColumn('types', function ($data) {

        $btn = '<a  href="javascript:void(0)"   data-id="' . $data->id . '" class="subCategoryTypes btn btn-link btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
        return $btn;
      })

      ->rawColumns(['action', 'status', 'brands', 'more', 'types'])
      ->make(true);
  }

  public function more($id)
  {

    $result = subCategory::where('id', $id)->get()->first();
    return $result;
  }

  public function edit($id)
  {

    $result = subCategory::where('id', $id)->get()->first();
    return $result;
  }

  public function update(Request $request)
  {

    $request->validate([

      'name' => 'required|max:45',
      'description' => 'required|max:250',

    ]);


    if (isset($request->subcat_status)) {

      $status = 1;
      // return $status;
    } else {
      $status = 0;
      // return $status;
    } //check binary button

    // update data 
    $update_subcat = subCategory::find($request->id);
    $update_subcat->sub_cat_name = $request->name;
    $update_subcat->sub_cat_description = $request->description;
    $update_subcat->status = $status;
    $result = $update_subcat->save();

    if ($result) {
      return response()->json(['code' => 'true', 'msg' => 'Subcategory updated']);
    } else {
      return response()->json(['code' => 'false', 'msg' => 'Something went wrong']);
    }
  }

  public function delete($id)
  {

    $delete_subcat = subCategory::find($id);
    $delete_subcat->status = 0;
    $result = $delete_subcat->save();

    if ($result) {
      return response()->json(['code' => 'true', 'msg' => 'Subcategory Deactivated']);
    } else {

      return response()->json(['code' => 'true', 'msg' => 'Something went wrong !!!']);
    }
  }
}
