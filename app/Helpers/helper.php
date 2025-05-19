<?php

use App\Models\ProductImage;




function getProductImage($productId){
    return ProductImage::where('product_id',$productId)->first();
}






?>

