<?php

namespace App\Contracts;

interface AdsInterface
{
    public function create_property(array $data);
    public function create_electronic(array $data);
    public function create_vehicle(array $data);
    public function create_education(array $data);
    public function create_jobs(array $data);
    public function create_service(array $data);
}
