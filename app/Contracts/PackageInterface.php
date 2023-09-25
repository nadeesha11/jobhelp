<?php

namespace App\Contracts;

interface PackageInterface
{
    public function index();
    public function recievePackages();
    public function update(array $data);
    public function delete($id);
    public function getEditPackages($id);
}
