<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use PhpParser\Node\Stmt\TryCatch;

class userAuthController extends Controller
{
    public function userForm()
    {
        return view('web.auth.user-form');
    }

    public function telValidation($phone_input_val)
    {
        $phone_input_val->validate([
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
        ]);
    }

    public function registerOTP(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|digits:9'
        ], [
            'required' => 'Phone number is required',
            'digits' => 'Phone number format in invalid'
        ]); // validate otp

        $phone_number = "+94" . $request->phone_number;  // make phone number as international version 
        $user_check =  DB::table('users')->where('phone_number', $phone_number)->first(); //check phone number currently available or not

        if (isset($user_check)) { //this is existing user
            $user_id = DB::table('users')->where('phone_number', $phone_number)->pluck('id')->first(); // get user id 
            // update otp 
            $update_otp = DB::table('otp_verifications')->where('user_id', $user_id)->update(array(
                'otp' => mt_rand(111111, 999999),
                'expire_at' => Carbon::now()->addMinute(15),
            ));
            $otp = DB::table('otp_verifications')->where('user_id', $user_id)->first(); // get updated otp raw id
            return response()->json(['otp' => $otp, 'code' => 'popup_otp_enter_modal']);
            //otp send to customer

        } else { //this is new user
            $new_user = DB::table('users')->insertGetId(array("first_name" => null, "last_name" => null, "email" => null, "phone_number" => $phone_number, "email" => null, "role" => "web", "key" => uniqid(), "status" => 1, 'free' => 10, 'created_at' => Carbon::now())); //  create new user  
            if ($new_user) {
                // get new user id and add phone number to otp_verifications table 
                $create_otp = DB::table('otp_verifications')->insertGetId(array(
                    'user_id' => $new_user,
                    'otp' => mt_rand(111111, 999999),
                    'expire_at' => Carbon::now()->addMinute(15),
                ));

                if ($create_otp) { //if otp table create success
                    $otp = DB::table('otp_verifications')->where('id', $create_otp)->first();
                    // testing sms gateway start 

                    // testing sms gateway end 

                    // *** this otp should send to customer phone 
                    return response()->json(['otp' => $otp, 'code' => 'popup_otp_enter_modal']);
                    // *** this otp should send to customer phone 
                } else { //if otp table unsuccess
                    return "otp raw not created";
                }
            } else {
                return "new user create not success";
            }
        }
    }

    public function checkOTP(Request $request)
    {

        $request->validate([
            'otp' => 'required|exists:otp_verifications,otp'
        ], [
            'required' => 'otp required',
            'exists' => 'otp doesnt match',
        ]);

        // check otp code with id 
        $check_otp_with_user_id = DB::table('otp_verifications')->where('user_id', $request->user_id)->where('otp', $request->otp)->first();

        $now = Carbon::now();

        if (isset($check_otp_with_user_id) && $now->isBefore($request->expire_at)) {
            //get user key 
            $key =   DB::table('users')->where('id', $request->user_id)->pluck('key')->first();
            Session::put('vendorLogin', $key);
            return response()->json(['code' => 'success', 'user_id' => $key]);
        } else {

            return response()->json(['msg' => 'user id and otp doesnt match', 'code' => 'error']);
        }
    }

    public function redirectGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle()
    {
        try {
            $google_user =  Socialite::driver('google')->user();
            $user = DB::table('users')->where('google-id', $google_user->getId())->first();
            if (!$user) {

                $new_key = uniqid();
                //create new user
                $new_google_user = DB::table('users')->insertGetId(array(
                    "first_name" => $google_user->getName(),
                    "last_name" => null,
                    "email" => $google_user->getEmail(),
                    "google-id" => $google_user->getId(),
                    "role" => "web",
                    "key" => $new_key,
                    'status' => 1
                )); //  create new user  

                Session::put('vendorLogin', $new_key);
                return redirect()->to('/web/vendorDashboard/' . $new_key);
            } else {
                Session::put('vendorLogin', $user->key);
                return redirect()->to('/web/vendorDashboard/' . $user->key);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function redirectFacebook()
    {
    }

    public function callbackFacebook()
    {
    }

    public function privacy()
    {

        return "terms";
    }

    public function logout()
    {
        Session::flush();  // flush all sessions
        return redirect()->route('web.userForm');
    }
}
