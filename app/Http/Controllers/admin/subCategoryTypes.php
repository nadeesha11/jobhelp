<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\subCategoryTypesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class subCategoryTypes extends Controller
{
    public function index($id)
    {

        return view('adminPanel.subCategoryTypes.index', compact('id'));
    }

    public function create(Request $request)
    {

        $request->validate([
            'name' => 'required|max:40',
        ]);

        $insert = new subCategoryTypesModel;
        $insert->sct_name = $request->name;
        $insert->sub_cat_id = $request->id;
        $result = $insert->save();

        if ($result) {
            return response()->json(['code' => 'true', 'msg' => 'Subcategory type created']);
        } else {
            return response()->json(['code' => 'false', 'msg' => 'Something went wrong']);
        }
    }

    public function getData($id)
    {

        $data =  DB::table('sub_category_types')->where('sub_cat_id', $id)->get();

        return datatables()->of($data)
            ->addIndexColumn()

            ->addColumn('action', function ($data) {
                $btn = '<a  href="javascript:void(0)"   data-id="' . $data->id . '" class="edit_types btn btn-warning btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
                $btn = $btn . '<a  href="javascript:void(0)" data-id="' . $data->id . '" class="delete_types btn btn-danger btn-sm"><i class="ik ik-trash-2"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function edit($id)
    {

        $data =  subCategoryTypesModel::find($id);
        return $data;
    }

    public function update(Request $request)
    {

        $request->validate([
            'name' => 'required|max:25'
        ]);

        $update = subCategoryTypesModel::find($request->id);
        $update->sct_name = $request->name;
        $result = $update->save();

        if ($result) {
            return response()->json(['code' => 'true', 'msg' => 'Subcategory type edited']);
        } else {
            return response()->json(['code' => 'false', 'msg' => 'Something went wrong !!!']);
        }
    }

    public function delete($id)
    {

        $delete = subCategoryTypesModel::find($id);
        $result = $delete->delete();

        if ($result) {
            return response()->json(['code' => 'true', 'msg' => 'Subcategory type edited']);
        } else {
            return response()->json(['code' => 'false', 'msg' => 'Something went wrong !!!']);
        }
    }
}
