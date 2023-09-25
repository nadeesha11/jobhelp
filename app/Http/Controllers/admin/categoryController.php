<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\category;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class categoryController extends Controller
{
    public function index(){


        return view('adminPanel.category.index');
    }

    public function create_category(Request $request){

       
        $request->validate([
       
       'category_name'=>'required|max:40',
       'category_description'=>'required|max:250',
       'category_image'=>'required|image|max:500'

        ]);//validate form data

        $cat_image = time().rand(1,1000).'.'.$request->category_image->extension();
        $request->category_image->move(public_path("uploaded_images/cat_images"),$cat_image);//rename image and upload

           $caregory = new category;
           $caregory->cat_name = $request['category_name'];
           $caregory->cat_description = $request['category_description'];
		   $caregory->status = 1;
		   $caregory->cat_image = $cat_image;
		   $result =	$caregory->save(); 	    

        if($result){
            return response()->json(['code'=>'true','msg'=>'Category created']);
        }
        else{
            return response()->json(['code'=>'false','msg'=>'Soemthing went wrong']);
        }
    }

    public function getData(){

        $data =  DB::table('category')->get();
        unset($data[0]);

        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('action', function($data){
               $btn = '<a  href="javascript:void(0)"   data-id="'.$data->id.'" class="edit_category btn btn-warning btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
               $btn = $btn.'<a  href="javascript:void(0)" data-id="'.$data->id.'" class="delete_category btn btn-danger btn-sm"><i class="ik ik-trash-2"></i></a>';
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
          ->addColumn('more', function($data){
           
            $btn = '<a  href="javascript:void(0)"   data-id="'.$data->id.'" class="more btn btn-info btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
            return $btn;
          })
          ->addColumn('subcategory', function($data){
           
            $btn = '<a  href="javascript:void(0)"   data-id="'.$data->id.'" class="subcategory btn btn-link btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
            return $btn;
          })
    
        ->rawColumns(['action','status','more','subcategory'])
        ->make(true);

    }

    public function moreData($id){

    $more_data = category::where('id',$id)->first();

    return $more_data;

    }

    public function delete($id){

        $employee = category::find($id);
        $employee->status = 0;
        $result =  $employee->save();  

        if($result){
            return response()->json(['code'=>'true','msg'=>'Category deleted']);
        }
        else{
            return response()->json(['code'=>'false','msg'=>'Soemthing went wrong']);
        }
    }

    public function edit($id){

        $edit_data = category::where('id',$id)->first();

        return $edit_data;

    }

    public function update(Request $request){

       

        $request->validate([
       
            'name'=>'required',
            'description'=>'required|max:250',
            'category_image'=>'image|max:500'
     
             ]);//validate form data

            
        //   start remove image if new image exists 
        if($request->hasFile('category_image')){

            $cat_image = category::where('id',$request->id)->pluck('cat_image')->first();
            $destination = 'uploaded_images/cat_images'.$cat_image;
            if(File::exists($destination)){
                File::delete($destination);
               }

               $cat_image = time().rand(1,1000).'.'.$request->category_image->extension();
               $request->category_image->move(public_path("uploaded_images/cat_images"),$cat_image);//rename image and upload   

            }else{
                $cat_image = category::where('id',$request->id)->pluck('cat_image')->first(); 
            }
       

        //   end remove image if new image exists 

          if(isset( $request->cat_status)){

            $status = 1;
            // return $status;
           }
           else{
            $status = 0;
            // return $status;
           }//check binary button

           $category = category::find($request->id);
           $category->cat_name = $request->name;
           $category->cat_description = $request->description;
           $category->cat_image = $cat_image;
           $category->status = $status;
           $category->updated_at = Carbon::now();
           $result =   $category->save();

          if($result){ 
          return response()->json(['code'=>'true','msg'=>'category updated']);
          }
          else{
          return response()->json(['code'=>'false','msg'=>'somethong went wrong']); 
          }

    }




}
