<?php

namespace App\Contracts;

interface adsTypesInterface
{
    public function index($id);
    public function create(array $data);
    public function getAjaxDetails($id);
    public function edit($id);
    public function update(array $data);
    public function delete($id);
    // public function getEditPackages($id);
}
