<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    



    public function product_images(){
        return $this->hasMany(ProductImage::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');  // Make sure 'category_id' exists in 'products' table
    }




    
}



