<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table = 'category';
    protected $fillable = [

    'cat_name',
    'cat_description',
    'status',
    'cat_image',
    'created_at',
    'updated_at'

     ];
}
