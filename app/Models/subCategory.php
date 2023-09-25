<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subCategory extends Model
{
    use HasFactory;
    protected $table = 'subcategory';
    protected $fillable = [

    'sub_cat_name',
    'sub_cat_description',
    'status',
    'cat_id',
    'created_at',
    'updated_at'

     ];

}
