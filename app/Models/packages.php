<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class packages extends Model
{
    protected $table = 'packages';
    use HasFactory;
    public function getAdsTypes()
    {
        return $this->hasMany(ads_types::class, 'ads_package_id')->where('status', 1);
    }
}
