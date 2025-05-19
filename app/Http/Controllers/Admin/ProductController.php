<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\TempImage;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;




class ProductController extends Controller
{
    public function index(Request $request){

        $products = Product::latest();

        if(!empty($request->get("Keyword"))){
            $products = $products->where("title","like",'%'. $request->get('Keyword') .'%');
        }

        $products = $products->paginate(10);


        return view('admin.Product.list',compact('products'));
    }


    public function create(){
        $categories =  Category::all();


        return view('admin.Product.create', compact('categories'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'category' => 'required',
            'is_featured' => 'required',
            'qty' => 'required',
            'status' => 'required',
        ]);


        if($validator->passes()){
            
            $product = new Product();
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->price = $request->price;
            $product->qty = $request->qty;
            $product->category_id = $request->category;
            $product->is_featured = $request->is_featured;
            $product->status = $request->status;
            $product->description = $request->description;
            $product->save();
                         
            

            //save gallery Pics
            if(!empty($request->image_array)){
                foreach($request->image_array as $temp_image_id){

                    $tempImageInfo = TempImage::find($temp_image_id);
                    $extArray = explode('.',$tempImageInfo->name);
                    $ext = last($extArray);


                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'NULL';
                    $productImage->save();



                    $imageName = $product->id . '-' . $productImage->id . '-' . time(). '.'. $ext;



                    $productImage->image = $imageName;
                    $productImage->save();
            

                    $sourcePath = public_path().'/temp/'. $tempImageInfo->name;



                    $destinationPath = public_path('/uploads/product/') . $imageName;
    
                    File::move($sourcePath, $destinationPath);
    
                    $tempImageInfo->delete();
                    

                }
            }            


            $request->session()->flash("success","product added succussfully");

            return response()->json([
                'status' => true,
                "message" => "product added successfully" 
            ]);

        }else{
            return response()->json([
                'status' => false,
                "errors" => $validator->errors()
            ]);
        }

    }




    public function edit($id,Request $request){

        $product = Product::find($id);
        $productImage = ProductImage::where('product_id',$product->id)->get();


        // dd($productImage);
        if($product == null){
            $message = "product not found";
            $request->session()->flash("error",$message);

            return redirect()->route('product.index');
        }


        $categories = Category::all();

        return view('admin.Product.edit',compact('product','categories','productImage'));
    }



    public function update(Request $request , $id){
        $product = Product::find($id);

        // dd($request->all());

        if($product == null){
            $message = "product not found";
            $request->session()->flash("error",$message);

            return redirect()->route('product.index');
        }


        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'slug' => 'required',
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'category' => 'required',
            'is_featured' => 'required',
            'qty' => 'required',
            'status' => 'required',
        ]);


        if($validator->passes()){
            
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->price = $request->price;
            $product->qty = $request->qty;
            $product->category_id = $request->category;
            $product->is_featured = $request->is_featured;
            $product->status = $request->status;
            $product->description = $request->description;
            $product->save();



            
            //save gallery Pics
            if(!empty($request->image_array_new)){
                foreach($request->image_array_new as $temp_image_id){

                    $tempImageInfo = TempImage::find($temp_image_id);
                    $extArray = explode('.',$tempImageInfo->name);
                    $ext = last($extArray);


                    $productImage = new ProductImage();
                    $productImage->product_id = $product->id;
                    $productImage->image = 'NULL';
                    $productImage->save();



                    $imageName = $product->id . '-' . $productImage->id . '-' . time(). '.'. $ext;



                    $productImage->image = $imageName;
                    $productImage->save();
            

                    $sourcePath = public_path().'/temp/'. $tempImageInfo->name;
                    $destinationPath = public_path('/uploads/product/') . $imageName;
    

                    File::move($sourcePath, $destinationPath);
                    $tempImageInfo->delete();
                }
            }            


            $request->session()->flash("success","product updated succussfully");

            return response()->json([
                'status' => true,
                "message" => "product added successfully" 
            ]);

        }else{
            return response()->json([
                'status' => false,
                "errors" => $validator->errors()
            ]);
        }

    }


    
    public function destroy($id,Request $request){
        $product = Product::find($id);


    
        if($product == null){
            $request->session()->flash("error","product not found");

            return response()->json([
                'status' => false 
            ]);         
        }

        $productImages = ProductImage::where("product_id", $id)->get();
        // delete image from folder
        if(!empty($productImages)){
            foreach($productImages as $productImage){
                File::delete(public_path('uploads/product/'.$productImage->image));
            }
            ProductImage::where("product_id", $id)->delete();
        }

        // $productImage

        $product->delete();


        $request->session()->flash("success","product deleted succussfully");

        
        return response()->json([
            'status' => true 
        ]);        
    }


   






}
