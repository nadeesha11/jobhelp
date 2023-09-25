<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminManagementController extends Controller
{
    public function adminManagement(){

        return view('adminPanel.adminManagement');

    }

    public function create_admin(Request $request){
   
        $request->validate([
        'admin_email'=>'required|unique:users,email|max:35|email:rfc,dns',
        'admin_password' => ['required','max:20','min:6','regex:/[a-z]/','regex:/[A-Z]/','regex:/[0-9]/','regex:/[@$!%*#?&]/'],
        ]);

        $admin = User::create(
            [
              
              'email' =>$request->admin_email,
              'password'=>Hash::make($request->admin_password),
              'role'=>"admin"
  
            ]
          );
  
          $admin->assignRole('admin');
  
          if($admin){
  
              return response()->json(['code' => 'true','msg'=>"admin created"]);
          }
          else{
  
              return response()->json(['code' => 'false','msg'=>"something went wrong"]);
          }

    }

   public function recieveadmin(){

    $data = DB::table('users')->where(function($query) {
        $query->where('role', 'admin')
            ->orWhere('role', 'superAdmin');
    })->orderBy('id')->get();



    return datatables()->of($data)
    ->addIndexColumn()
    ->addColumn('action', function($data){
        //    $btn = '<a style="font-size:10px;" href="javascript:void(0)"   data-id="'.$data->id.'" class="edit_admin btn btn-warning btn-sm m-2 "><i class="ik ik-edit-2"></i></a>';
           $btn = '<a style="font-size:10px;" href="javascript:void(0)" data-id="'.$data->id.'" class="delete_admin btn btn-danger btn-sm"><i class="ik ik-trash-2"></i></a>';
           return $btn;
    })
    ->rawColumns(['action'])
    ->make(true);


   }

   public function deleteAdmin($id){

     //start check this id belongs to superadmin 
     $check_superadmin = DB::table('users')
     ->where('id',$id)
     ->where('role','superAdmin')
     ->first();
 
  
    if($check_superadmin){
 
     return response()->json(['code'=>'superadmin','msg'=>"You Can't delete Superadmin"]);
    }
    else{
 
 
    //  start delete super admin 
 
     $success =  DB::table('users')->where('id', $id)->delete();
     if($success){
       return response()->json(['code'=>'true','msg'=>"Admin deleted succesful"]);
     }
     else{
       return response()->json(['code'=>'false','msg'=>"Admin delete fail"]);
     }
 
     //  end delete super admin
 
 
    }
 
    

   }






}
