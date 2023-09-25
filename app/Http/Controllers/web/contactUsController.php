<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Mail\contactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class contactUsController extends Controller
{
    public function contactus(){


        return view('web.contactUs');

    }

    public function sendMail(Request $request){

        $request->validate([

        'name'=>'required|max:40',
        'email'=>'required|email:rfc,dns|max:40',
        'subject'=>'required|max:100',
        'message'=>'required|max:1000' 

        ]);//validate contact form

        $contact = [

        'name'=>$request->name,
        'email'=>$request->email,
        'subject'=>$request->subject,
        'message'=>$request->message,

        ];

      

           
    if(   Mail::to("everspice.ceylone@gmail.com")->send(new contactUs($contact))    ){     
       return response()->json(['code'=>'true','msg'=>"message sent"]);
    }
    else{
        return response()->json(['code'=>'false','msg'=>"something went wrong"]);
    }




    }
}
