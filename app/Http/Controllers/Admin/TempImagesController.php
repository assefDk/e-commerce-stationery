<?php

namespace App\Http\Controllers\Admin;

use App\Models\TempImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;


class TempImagesController extends Controller
{
    
    public function create(Request $request){
        $image = $request->image;

        if(!empty($image)){
            $ext = $image->getClientOriginalExtension();
            $newName = time().".".$ext;

            $tempImage = new TempImage();
            $tempImage->name = $newName;
            $tempImage->save();

            $image->move(public_path().'/temp', $newName);


            return response()->json([
                'status' => true,
                'image_id' => $tempImage->id,
                'ImagePaht' => asset('/temp/'.$newName),
                'message' => 'Image uploaded successfully'
            ]);
        }

    }


    public function destroy(Request $request){        
        $tempImage = TempImage::find($request->id);
        
        if(empty($tempImage)){
            return response()->json([
                'status' => false,
                'message' => 'Image not found'
            ]);
        }


        // delete image from folder
        File::delete(public_path('temp/'.$tempImage->name));
        
        $tempImage->delete();

        return response()->json([
            'status' => true,
            'message' => 'Image deleted successfully'
        ]);

    }





}
