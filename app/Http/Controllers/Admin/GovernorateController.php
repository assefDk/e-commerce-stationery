<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Governorate;
use Illuminate\Support\Facades\Validator;


class GovernorateController extends Controller
{
    public function index(Request $request)
    {

        $governorates = Governorate::latest();

        if(!empty($request->get("Keyword"))){
            $governorates = $governorates->where("name","like",'%'. $request->get('Keyword') .'%');
        }


        $governorates = $governorates->paginate(10);

        return view('admin.governorate.list',compact('governorates'));
    }

     
    public function create()
    {
        return view('admin.governorate.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required'
        ]);



        if($validator->failed()){
            return response()->json([
                'status' => false ,
                "errors" => $validator->errors(),
            ]);
        } 



        $governorate = new Governorate;
        $governorate->name = $request->name;
        $governorate->save();

        return response()->json([
            "status" => true,
            "message" => 'Governorate added succussfully',
        ]);
    }

    public function destroy( $id,Request $request)
    {
        $governorate = Governorate::find($id);    
        
        if($governorate == null){
            $request->session()->flash("error","governorate Not Found");


            return response()->json([
                "status" => false,
                "message" => 'Governorate not found',
            ]);
        }

        $governorate->delete();

        $request->session()->flash("success","governorate deleted succussfully");


        return response()->json([
            "status" => true,
            "message" => 'governorate deleted succussfully',
        ]);
    }


}
