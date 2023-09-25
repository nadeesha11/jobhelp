<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subcategoryBrandsModel extends Model
{
    use HasFactory;

    protected $table = 'subcategory_brands';
    protected $fillable = [

    'brand_name',
    'status',
    'sub_cat_id',
    'created_at',
    'updated_at'

     ];
}
