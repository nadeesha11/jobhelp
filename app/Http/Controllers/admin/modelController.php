<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\brandmodelModel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class modelController extends Controller
{
    public function index($id){

        return view('adminPanel.subcategoryModels.index',compact('id'));
    }

    public function create(Request $request){

       $request->validate([
       'name'=>'required|unique:brandmodel,model_name|max:40'
       ]);

       $create = new brandmodelModel;
       $create->model_name = $request->name;
       $create->brand_id = $request->id;
       $create->status = 1;
       $result = $create->save(); 	    

    if($result){
        return response()->json(['code'=>'true','msg'=>'Category created']);
    }
    else{
        return response()->json(['code'=>'false','msg'=>'Soemthing went wrong']);
    }
    }

    public function getData($id){

        $data =  DB::table('brandmodel')->where('brand_id',$id)->get();
      
        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
               $btn = '<a  href="javascript:void(0)"   data-id="'.$data->id.'" class="edit_model btn btn-warning btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
               $btn = $btn.'<a  href="javascript:void(0)" data-id="'.$data->id.'" class="delete_model btn btn-danger btn-sm"><i class="ik ik-trash-2"></i></a>';
               return $btn;

        })
        ->addColumn('status', function($data){
            if($data->status==1){
              $status = '<span class="badge badge-pill badge-success mb-1">Active</span>';     
            }else{
              $status = '<span class="badge badge-pill badge-danger mb-1">Inactive</span>';   
            }
            return $status; 
          }) 
        ->rawColumns(['action','status'])
        ->make(true);
    }

    public function delete($id){

        $delete = brandmodelModel::find($id);
        $delete->status = 0;
        $result = $delete->save();
    
       if($result){
        return response()->json(['code'=>'true','msg'=>'Subcategory Deactivated']);
       }else{
        return response()->json(['code'=>'true','msg'=>'Something went wrong !!!']);
       }
    }

    public function edit($id){

     $models = brandmodelModel::find($id);
     return $models;

    }

    public function update(Request $request){

        $request->validate([
        'name'=>'required|max:25'
        ]);

      if(isset( $request->brand_status)){
        $status = 1;
       }
       else{
        $status = 0;
       }//check binary button
  
      // update data 
      $delete = brandmodelModel::find($request->id);
      $delete->model_name = $request->name;
      $delete->status = $status;
      $result = $delete->save();
  
      if($result){
       return response()->json(['code'=>'true','msg'=>'Model updated']);
      }
      else{
       return response()->json(['code'=>'false','msg'=>'Something went wrong']);
      }


    }

}
