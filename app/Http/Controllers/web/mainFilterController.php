<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mainFilterController extends Controller
{
    // *** for develop electronics category functions 
    protected function electronics($id)
    {
        // Forget a specific session variable
        session()->forget('electronics_filter_data');

        $ads = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 2)
            ->where('ads.sub_cat_id', $id)
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        return view('web.displayAdsFilters.electronics', compact('ads', 'id'));
    }

    public function electronicsFilterdRedirect(Request $request)
    {
        $oldFilterData = session('electronics_filter_data', []); // get old session data
        session([
            'electronics_filter_data' => [
                'min' => $request->min ?? ($oldFilterData['min'] ?? null),
                'max' => $request->max ?? ($oldFilterData['max'] ?? null),
                'subCat' => $request->subCat ?? ($oldFilterData['subCat'] ?? null),
                'new' => $request->new ?? null, // dont need old data
                'used' => $request->used ?? null, // dont need old data
            ]
        ]);
        return redirect()->route('electronics.filterd.ads');
    }

    public function electronicsFilterdDisplay(Request $request)
    {

        $adsQuery = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 2);

        $electronicsFilterData = session('electronics_filter_data', []);

        if (isset($electronicsFilterData['subCat'])) {
            $adsQuery->where('ads.sub_cat_id', $electronicsFilterData['subCat']);
        }
        if (isset($electronicsFilterData['min'])) {
            $adsQuery->where('ads.ads_price', '>=', $electronicsFilterData['min']);
        }
        if (isset($electronicsFilterData['max'])) {
            $adsQuery->where('ads.ads_price', '<=', $electronicsFilterData['max']);
        }
        if (isset($electronicsFilterData['new'])) {
            $adsQuery->where('electronics.ele_condition', $electronicsFilterData['new']);
        }
        if (isset($electronicsFilterData['used'])) {
            $adsQuery->where('electronics.ele_condition', $electronicsFilterData['used']);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('electronics', 'ads.id', '=', 'electronics.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);



        $id = $electronicsFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.electronics', compact('ads', 'id'));
    }
    // *** for develop electronics category functions ^^^^

    // *** for develop vehicles category functions 
    protected function vehicles($id)
    {
        // Forget a specific session variable
        session()->forget('vehicle_filter_data');

        $ads = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 3)
            ->where('ads.sub_cat_id', $id)
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        return view('web.displayAdsFilters.vehicles', compact('ads', 'id'));
    }

    public function vehiclesFilterdRedirect(Request $request)
    {

        $oldFilterDataVehicle = session('vehicle_filter_data', []); // get old session data
        session([
            'vehicle_filter_data' => [
                'min' => $request->min ?? ($oldFilterDataVehicle['min'] ?? null),
                'max' => $request->max ?? ($oldFilterDataVehicle['max'] ?? null),
                'subCat' => $request->subCat,
                'New' => $request->New ?? null, // dont need old data
                'Used' => $request->Used ?? null, // dont need old data
                'Reconditioned' => $request->Reconditioned ?? null, // dont need old data
            ]
        ]);

        return redirect()->route('vehicles.filterd.ads');
    }

    public function vehiclesFilterdDisplay(Request $request)
    {
        $vehiclesFilterData = session('vehicle_filter_data', []);

        $adsQuery = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 3);

        if (isset($vehiclesFilterData['subCat'])) {
            $adsQuery->where('ads.sub_cat_id', $vehiclesFilterData['subCat']);
        }

        if (isset($vehiclesFilterData['min'])) {
            $adsQuery->where('ads.ads_price', '>=', $vehiclesFilterData['min']);
        }

        if (isset($vehiclesFilterData['max'])) {
            $adsQuery->where('ads.ads_price', '<=', $vehiclesFilterData['max']);
        }

        if (isset($vehiclesFilterData['New'])) {
            $adsQuery->where('vehicle.condition',  $vehiclesFilterData['New']);
        }

        if (isset($vehiclesFilterData['Used'])) {
            $adsQuery->where('vehicle.condition',  $vehiclesFilterData['Used']);
        }

        if (isset($vehiclesFilterData['Reconditioned'])) {
            $adsQuery->where('vehicle.condition',  $vehiclesFilterData['Reconditioned']);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('vehicle', 'ads.id', '=', 'vehicle.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        $id = $vehiclesFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.vehicles', compact('ads', 'id'));
    }

    // *** for develop vehicles category functions ^^^^

    // *** for develop property category function  ^^^^
    public function property($id)
    {
        // Forget a specific session variable
        session()->forget('property_filter_data');

        $ads = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 4)
            ->where('ads.sub_cat_id', $id)
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        return view('web.displayAdsFilters.property', compact('ads', 'id'));
    }

    public function propertyFilterdRedirect(Request $request)
    {
        $oldFilterDataProperty = session('property_filter_data', []); // get old session data
        session([
            'property_filter_data' => [
                'min' => $request->min ?? ($oldFilterDataProperty['min'] ?? null),
                'max' => $request->max ?? ($oldFilterDataProperty['max'] ?? null),
                'subCat' => $request->subCat,
            ]
        ]);

        return redirect()->route('property.filterd.ads');
    }

    public function propertyFilterdDisplay()
    {
        $propertyFilterData = session('property_filter_data', []);

        $adsQuery = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 4);

        if (isset($propertyFilterData['subCat'])) {
            $adsQuery->where('ads.sub_cat_id', $propertyFilterData['subCat']);
        }

        if (isset($propertyFilterData['min'])) {
            $adsQuery->where('ads.ads_price', '>=', $propertyFilterData['min']);
        }

        if (isset($propertyFilterData['max'])) {
            $adsQuery->where('ads.ads_price', '<=', $propertyFilterData['max']);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('property', 'ads.id', '=', 'property.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        $id = $propertyFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.property', compact('ads', 'id'));
    }

    // *** for develop property category function  ^^^^

    // *** for develop service category function  ^^^^
    public function service($id)
    {
        // Forget a specific session variable
        session()->forget('service_filter_data');

        $ads = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 5)
            ->where('ads.sub_cat_id', $id)
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        return view('web.displayAdsFilters.service', compact('ads', 'id'));
    }

    public function serviceFilterdRedirect(Request $request)
    {
        // this should be tomorrow tasks
    }
    // *** for develop service category function  ^^^^
}
