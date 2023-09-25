<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adsManagementController extends Controller
{
    public function index()
    {
        return view('adminPanel.adsManagement.adsManagement');
    }
    public function recieveData()
    {
        $data = DB::table('ads')
            ->orderBy('id', 'desc') // Order by the 'created_at' column in descending order
            ->get();

        return datatables()->of($data)
            ->addIndexColumn()
            ->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    $status = '<span class="badge badge-pill badge-success mb-1">Active</span>';
                } else {
                    $status = '<span class="badge badge-pill badge-danger mb-1">Inactive</span>';
                }
                return $status;
            })
            ->addColumn('action', function ($data) {
                $btn = '<a  href="javascript:void(0)"   data-id="' . $data->id . '" class="action btn btn-warning btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
                return $btn;
            })
            ->addColumn('ads_type', function ($data) {
                $package = DB::table('ads_types')->where('id', $data->ads_type)->pluck('ads_package_id')->first();
                if ($package == null) {
                    $status = '<span class="badge badge-pill badge-success mb-1">normal ad</span>';
                } else if ($package == 1) {
                    $status = '<span class="badge badge-pill badge-danger mb-1">Top Ads</span>';
                } else if ($package == 2) {
                    $status = '<span class="badge badge-pill badge-danger mb-1">Urgent Ads</span>';
                } else if ($package == 3) {
                    $status = '<span class="badge badge-pill badge-danger mb-1">Spotlight Ads</span>';
                }
                return $status;
            })
            ->addColumn('more', function ($data) {
                $btn = '<a  href="javascript:void(0)"   data-id="' . $data->id . '" class="more btn btn-info btn-sm m-1 "><i class="ik ik-edit-2"></i></a>';
                return $btn;
            })
            ->rawColumns(['status', 'more', 'ads_type', 'action'])
            ->make(true);
    }
    public function detailed($id)
    {
        $ads_status = DB::table('ads')->where('id', $id)->pluck('status')->first();
        return view('adminPanel.adsDetailed.adsDetailed', compact('ads_status', 'id'));
    }
    public function statusChange(Request $request)
    {

        try {
            // Use $request->getContent() to get the raw JSON data from the request
            $jsonData = $request->getContent();

            // Use json_decode with the second parameter set to true to decode JSON into an associative array
            $data = json_decode($jsonData, true);

            // Check if $data is not null and contains the expected keys
            $result = DB::table('ads')->where('id', $data['ad_id'])->update([
                'status' => 0
            ]);

            if ($result) {
                return response()->json(['code' => 1, 'msg' => 'ad status updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'something went wrong']);
            }
        } catch (\Throwable $th) {
            return response()->json(['code' => 2, 'msg' => $th->getMessage()]);
        }
    }
    public function more($id)
    {
        $data = DB::table('ads')->where('id', $id)->first();
        return $data;
    }
    public function updateStatus(Request $request)
    {
        try {

            $status = (isset($request->status)) ? 1 : 0;

            // Check if $data is not null and contains the expected keys
            $result = DB::table('ads')->where('id', $request->id)->update([
                'status' => $status
            ]);

            if ($result) {
                return response()->json(['code' => 1, 'msg' => 'ad status updated']);
            } else {
                return response()->json(['code' => 0, 'msg' => 'something went wrong']);
            }
        } catch (\Throwable $th) {
            return response()->json(['code' => 2, 'msg' => $th->getMessage()]);
        }
    }
}
