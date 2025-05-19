<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(Request $request){

        $categories = Category::latest();

        if(!empty($request->get("Keyword"))){
            $categories = $categories->where("name","like",'%'. $request->get('Keyword') .'%');
        }

        $categories = $categories->paginate(10);

        return view('admin.Category.list',compact('categories'));
    }
 
    public function create(){

        return view('admin.Category.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "slug" => "required|unique:categories",
            "status" => "required"
        ]);

        if($validator->passes()){
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();


            $request->session()->flash("success","Category added succussfully");

            return response()->json([
                'status' => true,
                "message" => 'Category added succussfully',
            ]);

        }else{
            return response()->json([
                'status' => false ,
                "errors" => $validator->errors(),
            ]);
        }
    }


    public function edit(Request $request,$id){
        $category = Category::find($id);

        if($category == null){
            $request->session()->flash("error","Category not found");
            return redirect()->back();
        }

        return view('admin.Category.edit',compact('category'));
    }

    public function update(Request $request ,$id){
        $category = Category::find($id);

        if($category == null){
            $request->session()->flash("error","Category not found");
            return redirect()->back();
        }


        $validator = Validator::make($request->all(),[
            "name" => "required",
            "slug" => "required",
            "status" => "required"
        ]);

        if($validator->passes()){
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->save();


            $request->session()->flash("success","Category updated succussfully");

            return response()->json([
                'status' => true,
                "message" => 'Category added succussfully',
            ]);

        }else{
            return response()->json([
                'status' => false ,
                "errors" => $validator->errors(),
            ]);
        }
    }

    public function destroy(Request $request,$id){
        $category = Category::find($id);

        if($category == null){
            $request->session()->flash("error","Category Not Found");

            return response()->json([
                'status' => true,
                "message" => "Category Not Found",
            ]);
        }


        $category->delete();

        $request->session()->flash("success","Category deleted succussfully");

        return response()->json([
            'status' => true,
            "message" => "Category deleted succussfully",
        ]);
    }


}
