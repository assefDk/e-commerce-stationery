<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;


class ProductImageController extends Controller
{

    public function destroy(Request $request){
        $productImage = ProductImage::find($request->id);

        if(empty($productImage)){
            return response()->json([
                'status' => false,
                'message' => 'Image not found'
            ]);
        }


        // delete image from folder
        File::delete(public_path('uploads/product/'.$productImage->image));

        $productImage->delete();

        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully'
        ]);

    }

    
}
