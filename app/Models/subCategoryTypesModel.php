<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subCategoryTypesModel extends Model
{
    use HasFactory;
    protected $table = 'sub_category_types';
    protected $fillable = [

    'sct_name',
    'sub_cat_id',
    'created_at',
    'updated_at'

     ];
}
