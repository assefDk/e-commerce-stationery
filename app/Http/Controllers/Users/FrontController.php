<?php

namespace App\Http\Controllers\Users;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class FrontController extends Controller
{
    public function index(){
        
        $products = Product::where('is_featured', 'Yes')
                        ->with('category')
                        ->paginate(8);

        $data['featuredProducts'] = $products;

    


        $latesProducts = Product::where('is_featured', 'No')
                        ->with('category')
                        ->paginate(8);

        $data['latesProducts'] = $latesProducts;

        return view('user.home',$data);
    }


    public function shop($slug){
        
        $product = Product::where('slug',$slug)->first();
    

        if($product == null){
            abort(404);
        }
        
        $products = Product::where('is_featured', 'Yes')
                        ->with('category')
                        ->paginate(8);

        $data['featuredProducts'] = $products;

        $data['product'] = $product;
   

        return view('user.shop',$data);
    }



    public function categorie($categorySlug = null){

        $categorySelected = '';
        $data = [];
        
        $categories = Category::orderBy("name","ASC")->where('status',1)->get();
        $products = Product::where('status',1);
        
        // Apply filter here 
        if(!empty($categorySlug)){
            $category = Category::where('slug', $categorySlug)->first();
            $products = $products->where('category_id',$category->id);
            $categorySelected = $category->id;
        }
        
        $products = $products->paginate(10);
        
        $data['categories'] = $categories;
        $data['products'] = $products;
        $data['categorySelected'] = $categorySelected;


        // dd($data);
        return view("user.categories",$data);

    }

    
  

    
}
