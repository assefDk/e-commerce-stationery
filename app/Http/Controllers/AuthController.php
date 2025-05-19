<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }
    
    public function authenticate(Request $request){

        $validator = Validator::make($request->all(),[
            'email' => 'required|email|',
            'password' => 'required'
        ]); 

        if($validator->passes()){
            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                $user = Auth::user();


                if($user->role === 'admin'){
                    return redirect()->route('admin.dashbord');
                } else {

                    if(session()->has("url.intended")){
                        return redirect(session()->get("url.intended"));
                    }

                    return redirect()->route('account.orders');
                }
            } else {
                return redirect()->route("login")->with('error',' password or email not supported'); 
            }

        }else{
            return redirect()->route("login")
                    ->withErrors($validator)
                    ->withInput(request()->only('email'));
        }

    }   

    public function register(){
        return view('auth.register');
    }
    public function processRegister(Request $request){

        // dd($request->all());


        $validator = Validator::make($request->all(), [
            "name"=> "required|min:3",
            "email"=> "required|email|unique:users",
            "password"=> "required|min:5|confirmed",

        ]);

        if($validator->passes()){
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();


            

            $request->session()->flash("success","You have been registerd successfully.");


            return response()->json([
                "status"=> true,
            ]);

        } else {
            return response()->json([
                "status"=> false,
                "errors"=> $validator->errors(),
            ]);
        }

    }



    public function logout(){
        Auth::logout();
        return redirect()->route('user.home');
    }

    public function orders(){
        $data = [];
        $user = Auth::user();

        $orders = Order::where('user_id',$user->id)->orderBy('created_at','DESC')->get();

        $data['orders'] = $orders;
        return view('account.order',$data);
    }

    
    public function orderDetail($id){
        $data = [];
        $user = Auth::user();


        $order = Order::where('user_id',$user->id)->where('id',$id)->first();


        $orderItems = OrderItem::where('order_id',$id)->get();


        $orderItemsCount = OrderItem::where('order_id',$id)->count();


        $data['order'] = $order;
        $data['orderItems'] = $orderItems;
        $data['orderItemsCount'] = $orderItemsCount;
        return view('account.order-detail',$data);
    }


    public function wishlist(){

        $wishlists = Wishlist::where('user_id',Auth::user()->id)->with('product')->get();

        $data = [];
        $data['wishlists'] = $wishlists;

        return view('account.wishlist',$data);
    }


    public function addWishlist(Request $request){
        if(Auth::check() == false){

            session(['url.intended' => url()->previous()]);

            return response()->json([
                'status' => false,
            ]);
        }


        $product = Product::where('id',$request->id)->first();

        if($product == null){
            return response()->json([
                'status' => true,
                'message' => 'Product not found'
            ]);
        }


        Wishlist::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id
            ],
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->id
            ]
        );


        return response()->json([
            'status' => true,
            'message' => 'Added"'.$product->title.'"  to favourites'
        ]);
    }


    public function removeProductFromWishlists(Request $request){
        $wishlist = Wishlist::where('user_id',Auth::user()->id)
                ->where('product_id',$request->id)->first();

        if($wishlist == null){
            session()->flash('error','Product already removed');
            return response()->json([
                'status' => true,
            ]);
        } else{
            Wishlist::where('user_id',Auth::user()->id)
            ->where('product_id',$request->id)->delete();
            session()->flash('success','Product removed successfully.');
            return response()->json([
                'status' => true,
            ]);
        }
    }




}
