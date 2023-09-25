<?php

namespace App\Http\Controllers;

use App\Models\subcategoryBrandsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoryBrandsController extends Controller
{
    
    public function index($id){

    return view('adminPanel.subcategoryBrands.index',compact('id'));

    }

    public function create(Request $request){

        $request->validate([
          'brand'=>'required|max:25',  
        ]);

        // to create brands ********
       $create = new subcategoryBrandsModel;
       $create->sub_cat_id = $request->id;
       $create->brand_name = $request->brand;
       $create->status = 1;
       $result = $create->save();
        
       if($result){
            return response()->json(['code'=>'true','msg'=>'Brand created']);
        }
        else{
            return response()->json(['code'=>'false','msg'=>'Something went wrong !!!']);
        }
        }

     public function getData($id){

      $data =  DB::table('subcategory_brands')->where('sub_cat_id',$id)->get();
      
      return datatables()->of($data)
      ->addIndexColumn()
      ->addColumn('action', function($data){
             $btn = '<a  href="javascript:void(0)"   data-id="'.$data->id.'" class="edit_brand btn btn-warning btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
             $btn = $btn.'<a  href="javascript:void(0)" data-id="'.$data->id.'" class="delete_brand btn btn-danger btn-sm"><i class="ik ik-trash-2"></i></a>';
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
        ->addColumn('model', function($data){
         
          $btn = '<a  href="javascript:void(0)"   data-id="'.$data->id.'" class="model btn btn-link btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
          return $btn;
        })
  
      ->rawColumns(['action','status','model'])
      ->make(true);

     }

     public function delete($id){

      $delete = subcategoryBrandsModel::find($id);
      $delete->status = 0;
      $result =  $delete->save();  

      if($result){
          return response()->json(['code'=>'true','msg'=>'Brand deleted']);
      }
      else{
          return response()->json(['code'=>'false','msg'=>'Soemthing went wrong']);
      }
     }
  
     public function edit($id){

     $brand = subcategoryBrandsModel::find($id);
     return $brand;
     }

     public function update(Request $request){
     
     
      $request->validate([
        'name'=>'required|max:25',
       ]);

       if(isset( $request->brand_status)){
        $status = 1;
       }
       else{
        $status = 0;
       }//check binary button
  
      // update data 
      $update = subcategoryBrandsModel::find($request->id);
      $update->brand_name = $request->name;
      $update->status = $status;
      $result = $update->save();
  
    
      if($result){
       return response()->json(['code'=>'true','msg'=>'Brand updated']);
      }
      else{
       return response()->json(['code'=>'false','msg'=>'Something went wrong']);
      }


     }








}
