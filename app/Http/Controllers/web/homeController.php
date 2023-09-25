<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class homeController extends Controller
{
    public function index()
    {
        // get count of ads 
        $educationsCount = DB::table('ads')->where('cat_id', 7)->where('status', 1)->count();
        $electronicCount = DB::table('ads')->where('cat_id', 2)->where('status', 1)->count();
        $jobsCount = DB::table('ads')->where('cat_id', 6)->where('status', 1)->count();
        $propertyCount = DB::table('ads')->where('cat_id', 4)->where('status', 1)->count();
        $servicesCount = DB::table('ads')->where('cat_id', 5)->where('status', 1)->count();
        $vehicleCount = DB::table('ads')->where('cat_id', 3)->where('status', 1)->count();

        $categories = DB::table('category')->get();
        // remove first element
        $categories->shift();
        return view('web.home.webIndex', compact('categories', 'educationsCount', 'electronicCount', 'jobsCount', 'propertyCount', 'servicesCount', 'vehicleCount'));
    }

    public function test()
    {
        return view('web.carrosal');
    }
}
