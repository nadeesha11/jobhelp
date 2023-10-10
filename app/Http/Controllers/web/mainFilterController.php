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

        $brands = DB::table('subcategory_brands')->where('sub_cat_id', $id)->get();
        $cat_id = 2;
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

        return view('web.displayAdsFilters.electronics', compact('ads', 'id', 'cat_id', 'brands'));
    }

    public function electronicsFilterdRedirect(Request $request)
    {

        $oldFilterData = session('electronics_filter_data', []); // get old session data
        session([
            'electronics_filter_data' => [
                'min' => $request->min ??  null,
                'max' => $request->max ??  null,
                'subCat' => $request->subCat ?? ($oldFilterData['subCat'] ?? null),
                'new' => $request->new ?? null, // dont need old data
                'used' => $request->used ?? null, // dont need old data

                "Ampara"  => $request->Ampara ?? null,
                "Anuradhapura" => $request->Anuradhapura ?? null,
                "Badulla" => $request->Badulla ?? null,
                "Batticaloa" => $request->Batticaloa ?? null,
                "Colombo" => $request->Colombo ?? null,
                "Galle" => $request->Galle ?? null,
                "Gampaha" => $request->Gampaha ?? null,
                "Hambantota" => $request->Hambantota ?? null,
                "Jaffna" => $request->Jaffna ?? null,
                "Kalutara" => $request->Kalutara ?? null,
                "Kandy" => $request->Kandy ?? null,
                "Kegalle" => $request->Kegalle ?? null,
                "Kilinochchi" => $request->Kilinochchi ?? null,
                "Kurunegala" => $request->Kurunegala ?? null,
                "Mannar" => $request->Mannar ?? null,
                "Matale" => $request->Matale ?? null,
                "Matara" => $request->Matara ?? null,
                "Monaragala" => $request->Monaragala ?? null,
                "Mullaitivu" => $request->Mullaitivu ?? null,
                "Nuwara_Eliya" => $request->Nuwara_Eliya ?? null,
                "Polonnaruwa" => $request->Polonnaruwa ?? null,
                "Puttalam" => $request->Puttalam ?? null,
                "Ratnapura" => $request->Ratnapura ?? null,
                "Trincomalee" => $request->Trincomalee ?? null,
                "Vavuniya" => $request->Vavuniya ?? null,

                // air cooelr capacity data
                "capacity_12000" => $request->capacity_12000 ?? null,
                "capacity_18000" => $request->capacity_18000 ?? null,
                "capacity_22000" => $request->capacity_22000 ?? null,
                "capacity_24000" => $request->capacity_24000 ?? null,
                "capacity_other" => $request->capacity_other ?? null,

                // air cooler capacity data
                "inch_65" => $request->inch_65 ?? null,
                "inch_60" => $request->inch_60 ?? null,
                "inch_55" => $request->inch_55 ?? null,
                "inch_50" => $request->inch_50 ?? null,
                "inch_43" => $request->inch_43 ?? null,
                "inch_40" => $request->inch_40 ?? null,
                "inch_32" => $request->inch_32 ?? null,
                "inch_24" => $request->inch_24 ?? null,
                "inch_other" => $request->inch_other ?? null,

                //brands 


            ]
        ]);
        return redirect()->route('electronics.filterd.ads');
    }

    public function electronicsFilterdDisplay(Request $request)
    {
        $cat_id = 2;
        $electronicsFilterData = session('electronics_filter_data', []);

        //store values in array
        $conditionValues = []; // store electronics in a array
        if (isset($electronicsFilterData['new'])) {
            $conditionValues[] = $electronicsFilterData['new'];
        }
        if (isset($electronicsFilterData['used'])) {
            $conditionValues[] = $electronicsFilterData['used'];
        }

        $inches = []; // store electronics in a array
        if (isset($electronicsFilterData['inch_other'])) {
            $inches[] = $electronicsFilterData['inch_other'];
        }
        if (isset($electronicsFilterData['inch_24'])) {
            $inches[] = $electronicsFilterData['inch_24'];
        }
        if (isset($electronicsFilterData['inch_32'])) {
            $inches[] = $electronicsFilterData['inch_32'];
        }
        if (isset($electronicsFilterData['inch_40'])) {
            $inches[] = $electronicsFilterData['inch_40'];
        }
        if (isset($electronicsFilterData['inch_43'])) {
            $inches[] = $electronicsFilterData['inch_43'];
        }
        if (isset($electronicsFilterData['inch_50'])) {
            $inches[] = $electronicsFilterData['inch_50'];
        }
        if (isset($electronicsFilterData['inch_55'])) {
            $inches[] = $electronicsFilterData['inch_55'];
        }
        if (isset($electronicsFilterData['inch_60'])) {
            $inches[] = $electronicsFilterData['inch_60'];
        }
        if (isset($electronicsFilterData['inch_other'])) {
            $inches[] = $electronicsFilterData['inch_other'];
        }

        // need to add aircooler
        //store values in array
        $capacity = []; // store air filter capacity in a array
        if (isset($electronicsFilterData['capacity_other'])) {
            $capacity[] = $electronicsFilterData['capacity_other'];
        }
        if (isset($electronicsFilterData['capacity_24000'])) {
            $capacity[] = $electronicsFilterData['capacity_24000'];
        }
        if (isset($electronicsFilterData['capacity_22000'])) {
            $capacity[] = $electronicsFilterData['capacity_22000'];
        }
        if (isset($electronicsFilterData['capacity_18000'])) {
            $capacity[] = $electronicsFilterData['capacity_18000'];
        }
        if (isset($electronicsFilterData['capacity_12000'])) {
            $capacity[] = $electronicsFilterData['capacity_12000'];
        }

        //store values in array
        $locationValues = []; // store location in a array

        if (isset($electronicsFilterData['Ampara'])) {
            $locationValues[] = $electronicsFilterData['Ampara'];
        }
        if (isset($electronicsFilterData['Anuradhapura'])) {
            $locationValues[] = $electronicsFilterData['Anuradhapura'];
        }
        if (isset($electronicsFilterData['Badulla'])) {
            $locationValues[] = $electronicsFilterData['Badulla'];
        }
        if (isset($electronicsFilterData['Batticaloa'])) {
            $locationValues[] = $electronicsFilterData['Batticaloa'];
        }
        if (isset($electronicsFilterData['Colombo'])) {
            $locationValues[] = $electronicsFilterData['Colombo'];
        }
        if (isset($electronicsFilterData['Galle'])) {
            $locationValues[] = $electronicsFilterData['Galle'];
        }
        if (isset($electronicsFilterData['Gampaha'])) {
            $locationValues[] = $electronicsFilterData['Gampaha'];
        }
        if (isset($electronicsFilterData['Hambantota'])) {
            $locationValues[] = $electronicsFilterData['Hambantota'];
        }
        if (isset($electronicsFilterData['Jaffna'])) {
            $locationValues[] = $electronicsFilterData['Jaffna'];
        }
        if (isset($electronicsFilterData['Kalutara'])) {
            $locationValues[] = $electronicsFilterData['Kalutara'];
        }
        if (isset($electronicsFilterData['Kandy'])) {
            $locationValues[] = $electronicsFilterData['Kandy'];
        }
        if (isset($electronicsFilterData['Kegalle'])) {
            $locationValues[] = $electronicsFilterData['Kegalle'];
        }
        if (isset($electronicsFilterData['Kilinochchi'])) {
            $locationValues[] = $electronicsFilterData['Kilinochchi'];
        }
        if (isset($electronicsFilterData['Kurunegala'])) {
            $locationValues[] = $electronicsFilterData['Kurunegala'];
        }
        if (isset($electronicsFilterData['Mannar'])) {
            $locationValues[] = $electronicsFilterData['Mannar'];
        }
        if (isset($electronicsFilterData['Matale'])) {
            $locationValues[] = $electronicsFilterData['Matale'];
        }
        if (isset($electronicsFilterData['Matara'])) {
            $locationValues[] = $electronicsFilterData['Matara'];
        }
        if (isset($electronicsFilterData['Monaragala'])) {
            $locationValues[] = $electronicsFilterData['Monaragala'];
        }
        if (isset($electronicsFilterData['Mullaitivu'])) {
            $locationValues[] = $electronicsFilterData['Mullaitivu'];
        }
        if (isset($electronicsFilterData['Nuwara_Eliya'])) {
            $locationValues[] = $electronicsFilterData['Nuwara_Eliya'];
        }
        if (isset($electronicsFilterData['Polonnaruwa'])) {
            $locationValues[] = $electronicsFilterData['Polonnaruwa'];
        }
        if (isset($electronicsFilterData['Puttalam'])) {
            $locationValues[] = $electronicsFilterData['Puttalam'];
        }
        if (isset($electronicsFilterData['Ratnapura'])) {
            $locationValues[] = $electronicsFilterData['Ratnapura'];
        }
        if (isset($electronicsFilterData['Trincomalee'])) {
            $locationValues[] = $electronicsFilterData['Trincomalee'];
        }
        if (isset($electronicsFilterData['Vavuniya'])) {
            $locationValues[] = $electronicsFilterData['Vavuniya'];
        }

        $adsQuery = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 2);

        if (isset($electronicsFilterData['subCat'])) {
            $adsQuery->where('ads.sub_cat_id', $electronicsFilterData['subCat']);
        }
        if (isset($electronicsFilterData['min'])) {
            $adsQuery->where('ads.ads_price', '>=', $electronicsFilterData['min']);
        }
        if (isset($electronicsFilterData['max'])) {
            $adsQuery->where('ads.ads_price', '<=', $electronicsFilterData['max']);
        }
        if (!empty($conditionValues)) {
            $adsQuery->whereIn('electronics.ele_condition', $conditionValues);
        }
        if (!empty($locationValues)) {
            $adsQuery->whereIn('ads.ads_location', $locationValues);
        }
        if (!empty($capacity)) {
            $adsQuery->whereIn('electronics.elec_capacity', $capacity);
        }
        if (!empty($inches)) {
            $adsQuery->whereIn('electronics.elec_screen_size', $inches);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('electronics', 'ads.id', '=', 'electronics.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        $id = $electronicsFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.electronics', compact('ads', 'id', 'cat_id'));
    }
    // *** for develop electronics category functions ^^^^

    // *** for develop vehicles category functions 
    protected function vehicles($id)
    {
        $cat_id = 3;
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

        return view('web.displayAdsFilters.vehicles', compact('ads', 'id', 'cat_id'));
    }

    public function vehiclesFilterdRedirect(Request $request)
    {

        session([
            'vehicle_filter_data' => [
                'min' => $request->min ?? null,
                'max' => $request->max ?? null,
                'subCat' => $request->subCat,

                "Ampara"  => $request->Ampara ?? null,
                "Anuradhapura" => $request->Anuradhapura ?? null,
                "Badulla" => $request->Badulla ?? null,
                "Batticaloa" => $request->Batticaloa ?? null,
                "Colombo" => $request->Colombo ?? null,
                "Galle" => $request->Galle ?? null,
                "Gampaha" => $request->Gampaha ?? null,
                "Hambantota" => $request->Hambantota ?? null,
                "Jaffna" => $request->Jaffna ?? null,
                "Kalutara" => $request->Kalutara ?? null,
                "Kandy" => $request->Kandy ?? null,
                "Kegalle" => $request->Kegalle ?? null,
                "Kilinochchi" => $request->Kilinochchi ?? null,
                "Kurunegala" => $request->Kurunegala ?? null,
                "Mannar" => $request->Mannar ?? null,
                "Matale" => $request->Matale ?? null,
                "Matara" => $request->Matara ?? null,
                "Monaragala" => $request->Monaragala ?? null,
                "Mullaitivu" => $request->Mullaitivu ?? null,
                "Nuwara_Eliya" => $request->Nuwara_Eliya ?? null,
                "Polonnaruwa" => $request->Polonnaruwa ?? null,
                "Puttalam" => $request->Puttalam ?? null,
                "Ratnapura" => $request->Ratnapura ?? null,
                "Trincomalee" => $request->Trincomalee ?? null,
                "Vavuniya" => $request->Vavuniya ?? null,

                'New' => $request->New ?? null,
                'Used' => $request->Used ?? null,
                'Reconditioned' => $request->Reconditioned ?? null,

                'Other' => $request->Other ?? null,
                'Tiptronic' => $request->Tiptronic ?? null,
                'Automatic' => $request->Automatic ?? null,
                'Manual' => $request->Manual ?? null,

                'Diesel' => $request->Diesel ?? null,
                'Petrol' => $request->Petrol ?? null,
                'CNG' => $request->CNG ?? null,
                'Hybrid' => $request->Hybrid ?? null,
                'Electric' => $request->Electric ?? null,
                'other' => $request->other ?? null,

                'Saloon' => $request->Saloon ?? null,
                'Hatchback' => $request->Hatchback ?? null,
                'Station_wagon' => $request->Station_wagon ?? null,
                'Convertible' => $request->Convertible ?? null,
                'Coupé_Sports' => $request->Coupé_Sports ?? null,
                'SUV_4x4' => $request->SUV_4x4 ?? null,
                'MPV' => $request->MPV ?? null,
            ]
        ]);

        return redirect()->route('vehicles.filterd.ads');
    }

    public function vehiclesFilterdDisplay(Request $request)
    {
        $cat_id = 3;
        $vehiclesFilterData = session('vehicle_filter_data', []);

        //store values in array
        $body_type = []; // store electronics in a array
        if (isset($vehiclesFilterData['Saloon'])) {
            $body_type[] = $vehiclesFilterData['Saloon'];
        }
        if (isset($vehiclesFilterData['Hatchback'])) {
            $body_type[] = $vehiclesFilterData['Hatchback'];
        }
        if (isset($vehiclesFilterData['Station_wagon'])) {
            $body_type[] = $vehiclesFilterData['Station_wagon'];
        }
        if (isset($vehiclesFilterData['Convertible'])) {
            $body_type[] = $vehiclesFilterData['Convertible'];
        }
        if (isset($vehiclesFilterData['Coupé_Sports'])) {
            $body_type[] = $vehiclesFilterData['Coupé_Sports'];
        }
        if (isset($vehiclesFilterData['SUV_4x4'])) {
            $body_type[] = $vehiclesFilterData['SUV_4x4'];
        }
        if (isset($vehiclesFilterData['MPV'])) {
            $body_type[] = $vehiclesFilterData['MPV'];
        }

        //store values in array
        $conditionValues = []; // store electronics in a array
        if (isset($vehiclesFilterData['New'])) {
            $conditionValues[] = $vehiclesFilterData['New'];
        }
        if (isset($vehiclesFilterData['Used'])) {
            $conditionValues[] = $vehiclesFilterData['Used'];
        }
        if (isset($vehiclesFilterData['Reconditioned'])) {
            $conditionValues[] = $vehiclesFilterData['Reconditioned'];
        }

        //store values in array
        $fuel_type = []; // store electronics in a array
        if (isset($vehiclesFilterData['other'])) {
            $fuel_type[] = $vehiclesFilterData['other'];
        }
        if (isset($vehiclesFilterData['Electric'])) {
            $fuel_type[] = $vehiclesFilterData['Electric'];
        }
        if (isset($vehiclesFilterData['Hybrid'])) {
            $fuel_type[] = $vehiclesFilterData['Hybrid'];
        }
        if (isset($vehiclesFilterData['CNG'])) {
            $fuel_type[] = $vehiclesFilterData['CNG'];
        }
        if (isset($vehiclesFilterData['Petrol'])) {
            $fuel_type[] = $vehiclesFilterData['Petrol'];
        }
        if (isset($vehiclesFilterData['Diesel'])) {
            $fuel_type[] = $vehiclesFilterData['Diesel'];
        }

        $transmission = []; // store electronics in a array
        if (isset($vehiclesFilterData['Other'])) {
            $transmission[] = $vehiclesFilterData['Other'];
        }
        if (isset($vehiclesFilterData['Tiptronic'])) {
            $transmission[] = $vehiclesFilterData['Tiptronic'];
        }
        if (isset($vehiclesFilterData['Automatic'])) {
            $transmission[] = $vehiclesFilterData['Automatic'];
        }
        if (isset($vehiclesFilterData['Manual'])) {
            $transmission[] = $vehiclesFilterData['Manual'];
        }

        //store values in array
        $locationValues = []; // store location in a array

        if (isset($vehiclesFilterData['Ampara'])) {
            $locationValues[] = $vehiclesFilterData['Ampara'];
        }
        if (isset($vehiclesFilterData['Anuradhapura'])) {
            $locationValues[] = $vehiclesFilterData['Anuradhapura'];
        }
        if (isset($vehiclesFilterData['Badulla'])) {
            $locationValues[] = $vehiclesFilterData['Badulla'];
        }
        if (isset($vehiclesFilterData['Batticaloa'])) {
            $locationValues[] = $vehiclesFilterData['Batticaloa'];
        }
        if (isset($vehiclesFilterData['Colombo'])) {
            $locationValues[] = $vehiclesFilterData['Colombo'];
        }
        if (isset($vehiclesFilterData['Galle'])) {
            $locationValues[] = $vehiclesFilterData['Galle'];
        }
        if (isset($vehiclesFilterData['Gampaha'])) {
            $locationValues[] = $vehiclesFilterData['Gampaha'];
        }
        if (isset($vehiclesFilterData['Hambantota'])) {
            $locationValues[] = $vehiclesFilterData['Hambantota'];
        }
        if (isset($vehiclesFilterData['Jaffna'])) {
            $locationValues[] = $vehiclesFilterData['Jaffna'];
        }
        if (isset($vehiclesFilterData['Kalutara'])) {
            $locationValues[] = $vehiclesFilterData['Kalutara'];
        }
        if (isset($vehiclesFilterData['Kandy'])) {
            $locationValues[] = $vehiclesFilterData['Kandy'];
        }
        if (isset($vehiclesFilterData['Kegalle'])) {
            $locationValues[] = $vehiclesFilterData['Kegalle'];
        }
        if (isset($vehiclesFilterData['Kilinochchi'])) {
            $locationValues[] = $vehiclesFilterData['Kilinochchi'];
        }
        if (isset($vehiclesFilterData['Kurunegala'])) {
            $locationValues[] = $vehiclesFilterData['Kurunegala'];
        }
        if (isset($vehiclesFilterData['Mannar'])) {
            $locationValues[] = $vehiclesFilterData['Mannar'];
        }
        if (isset($vehiclesFilterData['Matale'])) {
            $locationValues[] = $vehiclesFilterData['Matale'];
        }
        if (isset($vehiclesFilterData['Matara'])) {
            $locationValues[] = $vehiclesFilterData['Matara'];
        }
        if (isset($vehiclesFilterData['Monaragala'])) {
            $locationValues[] = $vehiclesFilterData['Monaragala'];
        }
        if (isset($vehiclesFilterData['Mullaitivu'])) {
            $locationValues[] = $vehiclesFilterData['Mullaitivu'];
        }
        if (isset($vehiclesFilterData['Nuwara_Eliya'])) {
            $locationValues[] = $vehiclesFilterData['Nuwara_Eliya'];
        }
        if (isset($vehiclesFilterData['Polonnaruwa'])) {
            $locationValues[] = $vehiclesFilterData['Polonnaruwa'];
        }
        if (isset($vehiclesFilterData['Puttalam'])) {
            $locationValues[] = $vehiclesFilterData['Puttalam'];
        }
        if (isset($vehiclesFilterData['Ratnapura'])) {
            $locationValues[] = $vehiclesFilterData['Ratnapura'];
        }
        if (isset($vehiclesFilterData['Trincomalee'])) {
            $locationValues[] = $vehiclesFilterData['Trincomalee'];
        }
        if (isset($vehiclesFilterData['Vavuniya'])) {
            $locationValues[] = $vehiclesFilterData['Vavuniya'];
        }

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
        if (!empty($locationValues)) {
            $adsQuery->whereIn('ads.ads_location', $locationValues);
        }
        if (!empty($conditionValues)) {
            $adsQuery->whereIn('vehicle.condition', $conditionValues);
        }
        if (!empty($transmission)) {
            $adsQuery->whereIn('vehicle.transmission', $transmission);
        }
        if (!empty($fuel_type)) {
            $adsQuery->whereIn('vehicle.fuel_type', $fuel_type);
        }
        if (!empty($body_type)) {
            $adsQuery->whereIn('vehicle.body_type', $body_type);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('vehicle', 'ads.id', '=', 'vehicle.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        $id = $vehiclesFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.vehicles', compact('ads', 'id', 'cat_id'));
    }

    // *** for develop vehicles category functions ^^^^

    // *** for develop property category function  ^^^^
    public function property($id)
    {
        $cat_id = 4;
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

        return view('web.displayAdsFilters.property', compact('ads', 'id', 'cat_id'));
    }

    public function propertyFilterdRedirect(Request $request)
    {
        session([
            'property_filter_data' => [
                'min' => $request->min ?? null,
                'max' => $request->max ?? null,
                'subCat' => $request->subCat,

                "Ampara"  => $request->Ampara ?? null,
                "Anuradhapura" => $request->Anuradhapura ?? null,
                "Badulla" => $request->Badulla ?? null,
                "Batticaloa" => $request->Batticaloa ?? null,
                "Colombo" => $request->Colombo ?? null,
                "Galle" => $request->Galle ?? null,
                "Gampaha" => $request->Gampaha ?? null,
                "Hambantota" => $request->Hambantota ?? null,
                "Jaffna" => $request->Jaffna ?? null,
                "Kalutara" => $request->Kalutara ?? null,
                "Kandy" => $request->Kandy ?? null,
                "Kegalle" => $request->Kegalle ?? null,
                "Kilinochchi" => $request->Kilinochchi ?? null,
                "Kurunegala" => $request->Kurunegala ?? null,
                "Mannar" => $request->Mannar ?? null,
                "Matale" => $request->Matale ?? null,
                "Matara" => $request->Matara ?? null,
                "Monaragala" => $request->Monaragala ?? null,
                "Mullaitivu" => $request->Mullaitivu ?? null,
                "Nuwara_Eliya" => $request->Nuwara_Eliya ?? null,
                "Polonnaruwa" => $request->Polonnaruwa ?? null,
                "Puttalam" => $request->Puttalam ?? null,
                "Ratnapura" => $request->Ratnapura ?? null,
                "Trincomalee" => $request->Trincomalee ?? null,
                "Vavuniya" => $request->Vavuniya ?? null,
            ]
        ]);

        return redirect()->route('property.filterd.ads');
    }

    public function propertyFilterdDisplay()
    {
        $cat_id = 4;
        $propertyFilterData = session('property_filter_data', []);

        //store values in array
        $locationValues = []; // store location in a array

        if (isset($propertyFilterData['Ampara'])) {
            $locationValues[] = $propertyFilterData['Ampara'];
        }
        if (isset($propertyFilterData['Anuradhapura'])) {
            $locationValues[] = $propertyFilterData['Anuradhapura'];
        }
        if (isset($propertyFilterData['Badulla'])) {
            $locationValues[] = $propertyFilterData['Badulla'];
        }
        if (isset($propertyFilterData['Batticaloa'])) {
            $locationValues[] = $propertyFilterData['Batticaloa'];
        }
        if (isset($propertyFilterData['Colombo'])) {
            $locationValues[] = $propertyFilterData['Colombo'];
        }
        if (isset($propertyFilterData['Galle'])) {
            $locationValues[] = $propertyFilterData['Galle'];
        }
        if (isset($propertyFilterData['Gampaha'])) {
            $locationValues[] = $propertyFilterData['Gampaha'];
        }
        if (isset($propertyFilterData['Hambantota'])) {
            $locationValues[] = $propertyFilterData['Hambantota'];
        }
        if (isset($propertyFilterData['Jaffna'])) {
            $locationValues[] = $propertyFilterData['Jaffna'];
        }
        if (isset($propertyFilterData['Kalutara'])) {
            $locationValues[] = $propertyFilterData['Kalutara'];
        }
        if (isset($propertyFilterData['Kandy'])) {
            $locationValues[] = $propertyFilterData['Kandy'];
        }
        if (isset($propertyFilterData['Kegalle'])) {
            $locationValues[] = $propertyFilterData['Kegalle'];
        }
        if (isset($propertyFilterData['Kilinochchi'])) {
            $locationValues[] = $propertyFilterData['Kilinochchi'];
        }
        if (isset($propertyFilterData['Kurunegala'])) {
            $locationValues[] = $propertyFilterData['Kurunegala'];
        }
        if (isset($propertyFilterData['Mannar'])) {
            $locationValues[] = $propertyFilterData['Mannar'];
        }
        if (isset($propertyFilterData['Matale'])) {
            $locationValues[] = $propertyFilterData['Matale'];
        }
        if (isset($propertyFilterData['Matara'])) {
            $locationValues[] = $propertyFilterData['Matara'];
        }
        if (isset($propertyFilterData['Monaragala'])) {
            $locationValues[] = $propertyFilterData['Monaragala'];
        }
        if (isset($propertyFilterData['Mullaitivu'])) {
            $locationValues[] = $propertyFilterData['Mullaitivu'];
        }
        if (isset($propertyFilterData['Nuwara_Eliya'])) {
            $locationValues[] = $propertyFilterData['Nuwara_Eliya'];
        }
        if (isset($propertyFilterData['Polonnaruwa'])) {
            $locationValues[] = $propertyFilterData['Polonnaruwa'];
        }
        if (isset($propertyFilterData['Puttalam'])) {
            $locationValues[] = $propertyFilterData['Puttalam'];
        }
        if (isset($propertyFilterData['Ratnapura'])) {
            $locationValues[] = $propertyFilterData['Ratnapura'];
        }
        if (isset($propertyFilterData['Trincomalee'])) {
            $locationValues[] = $propertyFilterData['Trincomalee'];
        }
        if (isset($propertyFilterData['Vavuniya'])) {
            $locationValues[] = $propertyFilterData['Vavuniya'];
        }

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
        if (!empty($locationValues)) {
            $adsQuery->whereIn('ads.ads_location', $locationValues);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('property', 'ads.id', '=', 'property.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        $id = $propertyFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.property', compact('ads', 'id', 'cat_id'));
    }

    // *** for develop property category function  ^^^^

    // *** for develop service category function  ^^^^
    public function service($id)
    {
        $cat_id = 5;
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

        return view('web.displayAdsFilters.service', compact('ads', 'id', 'cat_id'));
    }

    public function serviceFilterdRedirect(Request $request)
    {

        session([
            'service_filter_data' => [
                'min' => $request->min ?? null,
                'max' => $request->max ?? null,
                'subCat' => $request->subCat,

                "Ampara"  => $request->Ampara ?? null,
                "Anuradhapura" => $request->Anuradhapura ?? null,
                "Badulla" => $request->Badulla ?? null,
                "Batticaloa" => $request->Batticaloa ?? null,
                "Colombo" => $request->Colombo ?? null,
                "Galle" => $request->Galle ?? null,
                "Gampaha" => $request->Gampaha ?? null,
                "Hambantota" => $request->Hambantota ?? null,
                "Jaffna" => $request->Jaffna ?? null,
                "Kalutara" => $request->Kalutara ?? null,
                "Kandy" => $request->Kandy ?? null,
                "Kegalle" => $request->Kegalle ?? null,
                "Kilinochchi" => $request->Kilinochchi ?? null,
                "Kurunegala" => $request->Kurunegala ?? null,
                "Mannar" => $request->Mannar ?? null,
                "Matale" => $request->Matale ?? null,
                "Matara" => $request->Matara ?? null,
                "Monaragala" => $request->Monaragala ?? null,
                "Mullaitivu" => $request->Mullaitivu ?? null,
                "Nuwara_Eliya" => $request->Nuwara_Eliya ?? null,
                "Polonnaruwa" => $request->Polonnaruwa ?? null,
                "Puttalam" => $request->Puttalam ?? null,
                "Ratnapura" => $request->Ratnapura ?? null,
                "Trincomalee" => $request->Trincomalee ?? null,
                "Vavuniya" => $request->Vavuniya ?? null,
            ]
        ]);

        return redirect()->route('service.filterd.ads');
    }

    public function serviceFilterdDisplay()
    {
        $cat_id = 5;
        $serviceFilterData = session('service_filter_data', []);

        //store values in array
        $locationValues = []; // store location in a array

        if (isset($serviceFilterData['Ampara'])) {
            $locationValues[] = $serviceFilterData['Ampara'];
        }
        if (isset($serviceFilterData['Anuradhapura'])) {
            $locationValues[] = $serviceFilterData['Anuradhapura'];
        }
        if (isset($serviceFilterData['Badulla'])) {
            $locationValues[] = $serviceFilterData['Badulla'];
        }
        if (isset($serviceFilterData['Batticaloa'])) {
            $locationValues[] = $serviceFilterData['Batticaloa'];
        }
        if (isset($serviceFilterData['Colombo'])) {
            $locationValues[] = $serviceFilterData['Colombo'];
        }
        if (isset($serviceFilterData['Galle'])) {
            $locationValues[] = $serviceFilterData['Galle'];
        }
        if (isset($serviceFilterData['Gampaha'])) {
            $locationValues[] = $serviceFilterData['Gampaha'];
        }
        if (isset($serviceFilterData['Hambantota'])) {
            $locationValues[] = $serviceFilterData['Hambantota'];
        }
        if (isset($serviceFilterData['Jaffna'])) {
            $locationValues[] = $serviceFilterData['Jaffna'];
        }
        if (isset($serviceFilterData['Kalutara'])) {
            $locationValues[] = $serviceFilterData['Kalutara'];
        }
        if (isset($serviceFilterData['Kandy'])) {
            $locationValues[] = $serviceFilterData['Kandy'];
        }
        if (isset($serviceFilterData['Kegalle'])) {
            $locationValues[] = $serviceFilterData['Kegalle'];
        }
        if (isset($serviceFilterData['Kilinochchi'])) {
            $locationValues[] = $serviceFilterData['Kilinochchi'];
        }
        if (isset($serviceFilterData['Kurunegala'])) {
            $locationValues[] = $serviceFilterData['Kurunegala'];
        }
        if (isset($serviceFilterData['Mannar'])) {
            $locationValues[] = $serviceFilterData['Mannar'];
        }
        if (isset($serviceFilterData['Matale'])) {
            $locationValues[] = $serviceFilterData['Matale'];
        }
        if (isset($serviceFilterData['Matara'])) {
            $locationValues[] = $serviceFilterData['Matara'];
        }
        if (isset($serviceFilterData['Monaragala'])) {
            $locationValues[] = $serviceFilterData['Monaragala'];
        }
        if (isset($serviceFilterData['Mullaitivu'])) {
            $locationValues[] = $serviceFilterData['Mullaitivu'];
        }
        if (isset($serviceFilterData['Nuwara_Eliya'])) {
            $locationValues[] = $serviceFilterData['Nuwara_Eliya'];
        }
        if (isset($serviceFilterData['Polonnaruwa'])) {
            $locationValues[] = $serviceFilterData['Polonnaruwa'];
        }
        if (isset($serviceFilterData['Puttalam'])) {
            $locationValues[] = $serviceFilterData['Puttalam'];
        }
        if (isset($serviceFilterData['Ratnapura'])) {
            $locationValues[] = $serviceFilterData['Ratnapura'];
        }
        if (isset($serviceFilterData['Trincomalee'])) {
            $locationValues[] = $serviceFilterData['Trincomalee'];
        }
        if (isset($serviceFilterData['Vavuniya'])) {
            $locationValues[] = $serviceFilterData['Vavuniya'];
        }

        $adsQuery = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 5);

        if (isset($serviceFilterData['subCat'])) {
            $adsQuery->where('ads.sub_cat_id', $serviceFilterData['subCat']);
        }

        if (isset($serviceFilterData['min'])) {
            $adsQuery->where('ads.ads_price', '>=', $serviceFilterData['min']);
        }

        if (isset($serviceFilterData['max'])) {
            $adsQuery->where('ads.ads_price', '<=', $serviceFilterData['max']);
        }
        if (!empty($locationValues)) {
            $adsQuery->whereIn('ads.ads_location', $locationValues);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('services', 'ads.id', '=', 'services.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        $id = $serviceFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.service', compact('ads', 'id', 'cat_id'));
    }
    // *** for develop service category function  ^^^^

    // *** for develop jobs category function  ^^^^

    public function jobs($id)
    {
        $cat_id = 6;
        // Forget a specific session variable
        session()->forget('jobs_filter_data');

        $ads = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 6)
            ->where('ads.sub_cat_id', $id)
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('jobs', 'ads.id', '=', 'jobs.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName', 'jobs.sallary_start_from', 'jobs.sallary_start_to')
            ->paginate(12);

        return view('web.displayAdsFilters.jobs', compact('ads', 'id', 'cat_id'));
    }

    public function jobsFilterdRedirect(Request $request)
    {

        session([
            'jobs_filter_data' => [
                'min' => $request->min ?? null,
                'max' => $request->max ?? null,
                'subCat' => $request->subCat,
                // work expirience
                'experience_1' => $request->experience_1 ?? null,
                'experience_2' => $request->experience_2 ?? null,
                'experience_3' => $request->experience_3 ?? null,
                'experience_4' => $request->experience_4 ?? null,
                'experience_5' => $request->experience_5 ?? null,
                'experience_6' => $request->experience_6 ?? null,
                'experience_7' => $request->experience_7 ?? null,
                'experience_8' => $request->experience_8 ?? null,
                'experience_9' => $request->experience_9 ?? null,
                'experience_10' => $request->experience_10 ??  null,
                'experience_more_than_10' => $request->experience_more_than_10 ?? null,
                // education
                'Skilled_Apprentice' => $request->Skilled_Apprentice ?? null,
                'Docterate' => $request->Docterate ?? null,
                'Masters' => $request->Masters ?? null,
                'Degree' => $request->Degree ?? null,
                'Higher_Diploma' => $request->Higher_Diploma ?? null,
                'Diploma' => $request->Diploma ?? null,
                'Certificate' => $request->Certificate ?? null,
                'Advanced_Level' => $request->Advanced_Level ?? null,
                'Ordinary_Level' => $request->Ordinary_Level ?? null,
                // type
                'Full_Time' => $request->Full_Time ?? null,
                'Part_Time' => $request->Part_Time ?? null,
                'Temporary' => $request->Temporary ?? null,
                'Internship' => $request->Internship ?? null,
                'Contractual' => $request->Contractual ?? null,
                //location data 
                "Ampara"  => $request->Ampara ?? null,
                "Anuradhapura" => $request->Anuradhapura ?? null,
                "Badulla" => $request->Badulla ?? null,
                "Batticaloa" => $request->Batticaloa ?? null,
                "Colombo" => $request->Colombo ?? null,
                "Galle" => $request->Galle ?? null,
                "Gampaha" => $request->Gampaha ?? null,
                "Hambantota" => $request->Hambantota ?? null,
                "Jaffna" => $request->Jaffna ?? null,
                "Kalutara" => $request->Kalutara ?? null,
                "Kandy" => $request->Kandy ?? null,
                "Kegalle" => $request->Kegalle ?? null,
                "Kilinochchi" => $request->Kilinochchi ?? null,
                "Kurunegala" => $request->Kurunegala ?? null,
                "Mannar" => $request->Mannar ?? null,
                "Matale" => $request->Matale ?? null,
                "Matara" => $request->Matara ?? null,
                "Monaragala" => $request->Monaragala ?? null,
                "Mullaitivu" => $request->Mullaitivu ?? null,
                "Nuwara_Eliya" => $request->Nuwara_Eliya ?? null,
                "Polonnaruwa" => $request->Polonnaruwa ?? null,
                "Puttalam" => $request->Puttalam ?? null,
                "Ratnapura" => $request->Ratnapura ?? null,
                "Trincomalee" => $request->Trincomalee ?? null,
                "Vavuniya" => $request->Vavuniya ?? null,
            ]
        ]);

        return redirect()->route('jobs.filterd.ads');
    }

    public function jobsFilterdDisplay()
    {
        $cat_id = 6;
        $jobsFilterData = session('jobs_filter_data', []);

        $experienceValues = []; // store expirience in a aarray
        if (isset($jobsFilterData['experience_1'])) {
            $experienceValues[] = $jobsFilterData['experience_1'];
        }

        if (isset($jobsFilterData['experience_2'])) {
            $experienceValues[] = $jobsFilterData['experience_2'];
        }
        if (isset($jobsFilterData['experience_3'])) {
            $experienceValues[] = $jobsFilterData['experience_3'];
        }

        if (isset($jobsFilterData['experience_4'])) {
            $experienceValues[] = $jobsFilterData['experience_4'];
        }
        if (isset($jobsFilterData['experience_5'])) {
            $experienceValues[] = $jobsFilterData['experience_5'];
        }

        if (isset($jobsFilterData['experience_6'])) {
            $experienceValues[] = $jobsFilterData['experience_6'];
        }
        if (isset($jobsFilterData['experience_7'])) {
            $experienceValues[] = $jobsFilterData['experience_7'];
        }

        if (isset($jobsFilterData['experience_8'])) {
            $experienceValues[] = $jobsFilterData['experience_8'];
        }
        if (isset($jobsFilterData['experience_9'])) {
            $experienceValues[] = $jobsFilterData['experience_9'];
        }

        if (isset($jobsFilterData['experience_10'])) {
            $experienceValues[] = $jobsFilterData['experience_10'];
        }
        if (isset($jobsFilterData['experience_more_than_10'])) {
            $experienceValues[] = $jobsFilterData['experience_more_than_10'];
        }

        $educationValues = []; // store education in a aarray
        if (isset($jobsFilterData['Ordinary_Level'])) {
            $educationValues[] = $jobsFilterData['Ordinary_Level'];
        }

        if (isset($jobsFilterData['Advanced_Level'])) {
            $educationValues[] = $jobsFilterData['Advanced_Level'];
        }
        if (isset($jobsFilterData['Certificate'])) {
            $educationValues[] = $jobsFilterData['Certificate'];
        }

        if (isset($jobsFilterData['Diploma'])) {
            $educationValues[] = $jobsFilterData['Diploma'];
        }
        if (isset($jobsFilterData['Higher_Diploma'])) {
            $educationValues[] = $jobsFilterData['Higher_Diploma'];
        }

        if (isset($jobsFilterData['Degree'])) {
            $educationValues[] = $jobsFilterData['Degree'];
        }
        if (isset($jobsFilterData['Masters'])) {
            $educationValues[] = $jobsFilterData['Masters'];
        }

        if (isset($jobsFilterData['Docterate'])) {
            $educationValues[] = $jobsFilterData['Docterate'];
        }
        if (isset($jobsFilterData['Skilled_Apprentice'])) {
            $educationValues[] = $jobsFilterData['Skilled_Apprentice'];
        }

        $jobTypeValues = []; // store job type in a array
        if (isset($jobsFilterData['Full_Time'])) {
            $jobTypeValues[] = $jobsFilterData['Full_Time'];
        }
        if (isset($jobsFilterData['Part_Time'])) {
            $jobTypeValues[] = $jobsFilterData['Part_Time'];
        }
        if (isset($jobsFilterData['Temporary'])) {
            $jobTypeValues[] = $jobsFilterData['Temporary'];
        }
        if (isset($jobsFilterData['Internship'])) {
            $jobTypeValues[] = $jobsFilterData['Internship'];
        }
        if (isset($jobsFilterData['Contractual'])) {
            $jobTypeValues[] = $jobsFilterData['Contractual'];
        }

        //store values in array
        $locationValues = []; // store location in a array

        if (isset($jobsFilterData['Ampara'])) {
            $locationValues[] = $jobsFilterData['Ampara'];
        }
        if (isset($jobsFilterData['Anuradhapura'])) {
            $locationValues[] = $jobsFilterData['Anuradhapura'];
        }
        if (isset($jobsFilterData['Badulla'])) {
            $locationValues[] = $jobsFilterData['Badulla'];
        }
        if (isset($jobsFilterData['Batticaloa'])) {
            $locationValues[] = $jobsFilterData['Batticaloa'];
        }
        if (isset($jobsFilterData['Colombo'])) {
            $locationValues[] = $jobsFilterData['Colombo'];
        }
        if (isset($jobsFilterData['Galle'])) {
            $locationValues[] = $jobsFilterData['Galle'];
        }
        if (isset($jobsFilterData['Gampaha'])) {
            $locationValues[] = $jobsFilterData['Gampaha'];
        }
        if (isset($jobsFilterData['Hambantota'])) {
            $locationValues[] = $jobsFilterData['Hambantota'];
        }
        if (isset($jobsFilterData['Jaffna'])) {
            $locationValues[] = $jobsFilterData['Jaffna'];
        }
        if (isset($jobsFilterData['Kalutara'])) {
            $locationValues[] = $jobsFilterData['Kalutara'];
        }
        if (isset($jobsFilterData['Kandy'])) {
            $locationValues[] = $jobsFilterData['Kandy'];
        }
        if (isset($jobsFilterData['Kegalle'])) {
            $locationValues[] = $jobsFilterData['Kegalle'];
        }
        if (isset($jobsFilterData['Kilinochchi'])) {
            $locationValues[] = $jobsFilterData['Kilinochchi'];
        }
        if (isset($jobsFilterData['Kurunegala'])) {
            $locationValues[] = $jobsFilterData['Kurunegala'];
        }
        if (isset($jobsFilterData['Mannar'])) {
            $locationValues[] = $jobsFilterData['Mannar'];
        }
        if (isset($jobsFilterData['Matale'])) {
            $locationValues[] = $jobsFilterData['Matale'];
        }
        if (isset($jobsFilterData['Matara'])) {
            $locationValues[] = $jobsFilterData['Matara'];
        }
        if (isset($jobsFilterData['Monaragala'])) {
            $locationValues[] = $jobsFilterData['Monaragala'];
        }
        if (isset($jobsFilterData['Mullaitivu'])) {
            $locationValues[] = $jobsFilterData['Mullaitivu'];
        }
        if (isset($jobsFilterData['Nuwara_Eliya'])) {
            $locationValues[] = $jobsFilterData['Nuwara_Eliya'];
        }
        if (isset($jobsFilterData['Polonnaruwa'])) {
            $locationValues[] = $jobsFilterData['Polonnaruwa'];
        }
        if (isset($jobsFilterData['Puttalam'])) {
            $locationValues[] = $jobsFilterData['Puttalam'];
        }
        if (isset($jobsFilterData['Ratnapura'])) {
            $locationValues[] = $jobsFilterData['Ratnapura'];
        }
        if (isset($jobsFilterData['Trincomalee'])) {
            $locationValues[] = $jobsFilterData['Trincomalee'];
        }
        if (isset($jobsFilterData['Vavuniya'])) {
            $locationValues[] = $jobsFilterData['Vavuniya'];
        }


        $adsQuery = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 6);

        if (isset($jobsFilterData['subCat'])) {
            $adsQuery->where('ads.sub_cat_id', $jobsFilterData['subCat']);
        }

        if (isset($jobsFilterData['min'])) {
            $adsQuery->where('jobs.sallary_start_to', '>=', $jobsFilterData['min']);
        }

        if (isset($jobsFilterData['max'])) {
            $adsQuery->where('jobs.sallary_start_from', '<=', $jobsFilterData['max']);
        }
        if (!empty($experienceValues)) {
            $adsQuery->whereIn('jobs.job_work_expirience', $experienceValues);
        }
        if (!empty($educationValues)) {
            $adsQuery->whereIn('jobs.job_education', $educationValues);
        }
        if (!empty($jobTypeValues)) {
            $adsQuery->whereIn('jobs.jobType', $jobTypeValues);
        }
        if (!empty($locationValues)) {
            $adsQuery->whereIn('ads.ads_location', $locationValues);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('jobs', 'ads.id', '=', 'jobs.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName', 'jobs.sallary_start_from', 'jobs.sallary_start_to')
            ->paginate(12);


        $id = $jobsFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.jobs', compact('ads', 'id', 'cat_id'));
    }
    // *** for develop jobs category function  ^^^^


    // *** for develop jobs category function  ^^^^
    public function education($id)
    {
        $cat_id = 7;
        session()->forget('education_filter_data');

        $ads = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 7)
            ->where('ads.sub_cat_id', $id)
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('educations', 'ads.id', '=', 'educations.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        return view('web.displayAdsFilters.education', compact('ads', 'id', 'cat_id'));
    }

    public function educationFilterdRedirect(Request $request)
    {
        session([
            'education_filter_data' => [
                'min' => $request->min ?? null,
                'max' => $request->max ?? null,
                'subCat' => $request->subCat,

                //location data 
                "Ampara"  => $request->Ampara ?? null,
                "Anuradhapura" => $request->Anuradhapura ?? null,
                "Badulla" => $request->Badulla ?? null,
                "Batticaloa" => $request->Batticaloa ?? null,
                "Colombo" => $request->Colombo ?? null,
                "Galle" => $request->Galle ?? null,
                "Gampaha" => $request->Gampaha ?? null,
                "Hambantota" => $request->Hambantota ?? null,
                "Jaffna" => $request->Jaffna ?? null,
                "Kalutara" => $request->Kalutara ?? null,
                "Kandy" => $request->Kandy ?? null,
                "Kegalle" => $request->Kegalle ?? null,
                "Kilinochchi" => $request->Kilinochchi ?? null,
                "Kurunegala" => $request->Kurunegala ?? null,
                "Mannar" => $request->Mannar ?? null,
                "Matale" => $request->Matale ?? null,
                "Matara" => $request->Matara ?? null,
                "Monaragala" => $request->Monaragala ?? null,
                "Mullaitivu" => $request->Mullaitivu ?? null,
                "Nuwara_Eliya" => $request->Nuwara_Eliya ?? null,
                "Polonnaruwa" => $request->Polonnaruwa ?? null,
                "Puttalam" => $request->Puttalam ?? null,
                "Ratnapura" => $request->Ratnapura ?? null,
                "Trincomalee" => $request->Trincomalee ?? null,
                "Vavuniya" => $request->Vavuniya ?? null,

            ]
        ]);

        return redirect()->route('education.filterd.ads');
    }

    public function educationFilterdDisplay()
    {
        $cat_id = 7;
        $educationFilterData = session('education_filter_data', []);

        //store values in array
        $locationValues = []; // store location in a array

        if (isset($educationFilterData['Ampara'])) {
            $locationValues[] = $educationFilterData['Ampara'];
        }
        if (isset($educationFilterData['Anuradhapura'])) {
            $locationValues[] = $educationFilterData['Anuradhapura'];
        }
        if (isset($educationFilterData['Badulla'])) {
            $locationValues[] = $educationFilterData['Badulla'];
        }
        if (isset($educationFilterData['Batticaloa'])) {
            $locationValues[] = $educationFilterData['Batticaloa'];
        }
        if (isset($educationFilterData['Colombo'])) {
            $locationValues[] = $educationFilterData['Colombo'];
        }
        if (isset($educationFilterData['Galle'])) {
            $locationValues[] = $educationFilterData['Galle'];
        }
        if (isset($educationFilterData['Gampaha'])) {
            $locationValues[] = $educationFilterData['Gampaha'];
        }
        if (isset($educationFilterData['Hambantota'])) {
            $locationValues[] = $educationFilterData['Hambantota'];
        }
        if (isset($educationFilterData['Jaffna'])) {
            $locationValues[] = $educationFilterData['Jaffna'];
        }
        if (isset($educationFilterData['Kalutara'])) {
            $locationValues[] = $educationFilterData['Kalutara'];
        }
        if (isset($educationFilterData['Kandy'])) {
            $locationValues[] = $educationFilterData['Kandy'];
        }
        if (isset($educationFilterData['Kegalle'])) {
            $locationValues[] = $educationFilterData['Kegalle'];
        }
        if (isset($educationFilterData['Kilinochchi'])) {
            $locationValues[] = $educationFilterData['Kilinochchi'];
        }
        if (isset($educationFilterData['Kurunegala'])) {
            $locationValues[] = $educationFilterData['Kurunegala'];
        }
        if (isset($educationFilterData['Mannar'])) {
            $locationValues[] = $educationFilterData['Mannar'];
        }
        if (isset($educationFilterData['Matale'])) {
            $locationValues[] = $educationFilterData['Matale'];
        }
        if (isset($educationFilterData['Matara'])) {
            $locationValues[] = $educationFilterData['Matara'];
        }
        if (isset($educationFilterData['Monaragala'])) {
            $locationValues[] = $educationFilterData['Monaragala'];
        }
        if (isset($educationFilterData['Mullaitivu'])) {
            $locationValues[] = $educationFilterData['Mullaitivu'];
        }
        if (isset($educationFilterData['Nuwara_Eliya'])) {
            $locationValues[] = $educationFilterData['Nuwara_Eliya'];
        }
        if (isset($educationFilterData['Polonnaruwa'])) {
            $locationValues[] = $educationFilterData['Polonnaruwa'];
        }
        if (isset($educationFilterData['Puttalam'])) {
            $locationValues[] = $educationFilterData['Puttalam'];
        }
        if (isset($educationFilterData['Ratnapura'])) {
            $locationValues[] = $educationFilterData['Ratnapura'];
        }
        if (isset($educationFilterData['Trincomalee'])) {
            $locationValues[] = $educationFilterData['Trincomalee'];
        }
        if (isset($educationFilterData['Vavuniya'])) {
            $locationValues[] = $educationFilterData['Vavuniya'];
        }

        $adsQuery = DB::table('ads')
            ->where('ads.status', 1)
            ->where('ads.cat_id', 7);

        if (isset($educationFilterData['subCat'])) {
            $adsQuery->where('ads.sub_cat_id', $educationFilterData['subCat']);
        }

        if (isset($educationFilterData['min'])) {
            $adsQuery->where('ads.ads_price', '>=', $educationFilterData['min']);
        }

        if (isset($educationFilterData['max'])) {
            $adsQuery->where('ads.ads_price', '<=', $educationFilterData['max']);
        }
        if (!empty($locationValues)) {
            $adsQuery->whereIn('ads.ads_location', $locationValues);
        }

        $ads = $adsQuery
            ->orderBy('ads.id', 'desc')
            ->join('subcategory', 'ads.sub_cat_id', '=', 'subcategory.id')
            ->join('educations', 'ads.id', '=', 'educations.ads_id')
            ->select('ads.*', 'subcategory.sub_cat_name as subCatName')
            ->paginate(12);

        $id = $educationFilterData['subCat']; // pass subcat values

        return view('web.displayAdsFilters.education', compact('ads', 'id', 'cat_id'));
    }
}
