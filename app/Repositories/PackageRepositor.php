<?php

namespace App\Repositories;

use App\Contracts\PackageInterface;
use Illuminate\Support\Facades\DB;

class PackageRepositor implements PackageInterface
{
    public function index()
    {
        return view('adminPanel.packages.index'); // view package blade
    }

    public function recievePackages()
    {
        $data =  DB::table('packages')->get();  // return db records using yajra 
        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($data) {
                $btn = '<a  href="javascript:void(0)"   data-id="' . $data->id . '" class="edit_package btn btn-warning btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
                $btn = $btn . '<a  href="javascript:void(0)" data-id="' . $data->id . '" class="delete_package btn btn-danger btn-sm"><i class="ik ik-trash-2"></i></a>';
                return $btn;
            })
            ->addColumn('ad_type', function ($data) {
                $btn = '<a  href="javascript:void(0)"   data-id="' . $data->id . '" class="ad_type btn btn-success btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
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
            ->rawColumns(['action', 'status', 'ad_type'])
            ->make(true);
    }
    public function update(array $data)
    {
        if (isset($data['package_status'])) {
            $status = 1;
        } else {
            $status = 0;
        }
        $result =  DB::table('packages')->where('id', $data['id'])
            ->update(['package_name' => $data['name'],  'status' => $status]);
        if ($result) {
            return response()->json(['code' => "true", 'msg' => 'Package updated']);
        } else {
            return response()->json(['code' => "false", 'msg' => 'Something went wrong !!!']);
        }
    }
    public function delete($id)
    {
        $result =  DB::table('packages')->where('id', $id)
            ->update(['status' => 0]);

        if ($result) {

            return response()->json(['code' => 'true', 'msg' => 'package deactivated']);
        } else {

            return response()->json(['code' => 'false', 'msg' => 'Something went wrong !!!']);
        }
    }
    public function getEditPackages($id)
    {
        $package = DB::table('packages')->find($id);
        return $package;
    }
}
