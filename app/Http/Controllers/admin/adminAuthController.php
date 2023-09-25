<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class adminAuthController extends Controller
{
    public function index()
    {


        return view('adminPanel.adminLogin');
    }

    public function authCheck(Request $request)
    {

        if (isset($request->remember_me)) {

            Cookie::queue('multivendor_emailname', $request->email, 1440);
            Cookie::queue('multivendor_password', $request->password, 1440);
        }


        $request->validate([

            'email' => 'required|exists:users,email|max:45|email:rfc,dns',
            'password' => 'required'

        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            Session::put('adminLogin', $credentials);

            // check remember me token clicked or not start

            // if( isset($request->remember_me) ){
            // Cookie::queue('agro_username',$request->name,1440);
            // Cookie::queue('agro_password',$request->password,1440);    
            // }

            return response()->json(['msg' => "", "code" => "success"]);
        } else {

            // return redirect()->back()->with('login_error','Username or Password incorrect');
            return response()->json(['msg' => "Username or Password incorrect", "code" => "error"]);
        }
    }

    public function logout()
    {

        Session::flush();  // flush all sessions

        return redirect()->route('admin.index');

        //   return redirect()->route('admin.index');

    }
}
