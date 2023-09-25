<?php

namespace App\Http\Controllers\admin;

use App\Contracts\adsTypesInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adsTypesController extends Controller
{
    public $adsTypes;
    function __construct(adsTypesInterface $adsTypes)
    {
        $this->adsTypes = $adsTypes;
    }

    public function index($id)
    {
        $data = $this->adsTypes->index($id);
        return $data;
    }
    public function create(Request $request)
    {
        $request->validate([
            'ad_type_name' => 'required|max:200',
            'ad_type_duration' => 'required|integer',
            'ad_type_price' => 'required|numeric|gt:0'
        ]);

        $data = $this->adsTypes->create($request->all());
        return $data;
    }
    public function getAjaxDetails($id)
    {
        $data = $this->adsTypes->getAjaxDetails($id);
        return $data;
    }
    public function delete($id)
    {
        $data = $this->adsTypes->delete($id);
        return $data;
    }
    public function edit($id)
    {
        $data = $this->adsTypes->edit($id);
        return $data;
    }
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            'duration' => 'required|integer',
            'price' => 'required|numeric|gt:0'
        ]);

        $data = $this->adsTypes->update($request->all());
        return $data;
    }
}
