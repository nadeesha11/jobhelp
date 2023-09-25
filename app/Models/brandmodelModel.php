<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class brandmodelModel extends Model
{
    use HasFactory;
    protected $table = 'brandmodel';
    protected $fillable = [

    'model_name',
    'status',
    'brand_id',
    'created_at',
    'updated_at'

     ];
}
