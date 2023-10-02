<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class mainFilterController extends Controller
{
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


        $id = $request->subCat; // pass subcat values

        return view('web.displayAdsFilters.electronics', compact('ads', 'id'));
    }
}
