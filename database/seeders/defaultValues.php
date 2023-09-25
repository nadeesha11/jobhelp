<?php

namespace Database\Seeders;

use App\Models\category;
use App\Models\subCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class defaultValues extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        // ***  some subcategories havent type and some have but we need to pass our records without null values so we create this default values 

      $defCategory = new category;
      $defCategory->cat_name = 'default';
      $defCategory->cat_description = 'default';
      $defCategory->status = 1;
      $defCategory->save();

      $insertedId = $defCategory->id;
      
      $defSubCategory = new subCategory;
      $defSubCategory->sub_cat_name = 'default';
      $defSubCategory->sub_cat_description = 'default';
      $defSubCategory->status = 1;
      $defSubCategory->cat_id = $insertedId;
      $defSubCategory->save();

    }
}
