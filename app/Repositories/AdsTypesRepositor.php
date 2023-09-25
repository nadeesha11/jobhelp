<?php

namespace App\Repositories;

use App\Contracts\adsTypesInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\FuncCall;

class AdsTypesRepositor implements adsTypesInterface
{
    public function index($id)
    {
        return view('adminPanel.packages.ads_types', compact('id')); //pass main ads category
    }
    public function create(array $data)
    {
        try {
            $result = DB::table('ads_types')->insert([
                'ads_package_id' => $data['id'],
                'name' => $data['ad_type_name'],
                'duration' => $data['ad_type_duration'],
                'price' => $data['ad_type_price'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
                'status' => 1,  // 1 for active 
            ]);
            if ($result) {
                return response()->json(['code' => 'true', 'msg' => 'Ad Type Created']);
            } else {
                return response()->json(['code' => 'false', 'msg' => 'Something Went Wrong !!!']);
            }
        } catch (\Throwable $th) {
            // Log the exception or handle it in an appropriate way
            // For now, let's return a simple error message as a JSON response
            return response()->json(['code' => 'false', 'msg' => 'An Error Occured']);
        }
    }
    public function getAjaxDetails($id)
    {
        $data =  DB::table('ads_types')->where('ads_package_id', $id);  // return db records using yajra 
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<a  href="javascript:void(0)"   data-id="' . $data->id . '" class="edit_ btn btn-warning btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
                $btn = $btn . '<a  href="javascript:void(0)" data-id="' . $data->id . '" class="delete_ btn btn-danger btn-sm"><i class="ik ik-trash-2"></i></a>';
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
            ->rawColumns(['action', 'status'])
            ->make(true);
    }
    public function delete($id)
    {
        try {
            $result = DB::table('ads_types')->where('id', $id)->update(['status' => 0]);
            if ($result) {
                return response()->json(['code' => 'true', 'msg' => 'Ad Type Deactivated']);
            } else {
                return response()->json(['code' => 'false', 'msg' => 'Something Went Wrong !!!']);
            }
        } catch (\Throwable $th) {
            // Log the exception or handle it in an appropriate way
            // For now, let's return a simple error message as a JSON response
            return response()->json(['code' => 'false', 'msg' => 'An Error Occured']);
        }
    }
    public function edit($id)
    {
        $data = DB::table('ads_types')->find($id);
        return $data;
    }
    public function update(array $data)
    {
        try {
            //check status 
            if (isset($data['ads_status_status'])) {
                $status = 1;
            } else {
                $status = 0;
            }
            //check status
            $result = DB::table('ads_types')->where('id', $data['id'])->update([
                'duration' => $data['duration'],
                'name' => $data['name'],
                'price' => $data['price'],
                'status' => $status,
            ]);
            if ($result) {
                return response()->json(['code' => 'true', 'msg' => 'Ad Type Updated']);
            } else {
                return response()->json(['code' => 'false', 'msg' => 'Something Went Wrong !!!']);
            }
        } catch (\Throwable $th) {
            // Log the exception or handle it in an appropriate way
            // For now, let's return a simple error message as a JSON response
            return response()->json(['code' => 'false', 'msg' => $th->getMessage()]);
        }
    }
}
