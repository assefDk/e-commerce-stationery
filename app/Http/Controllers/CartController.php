<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;


class CartController extends Controller
{
    
    

    public function addToCart(Request $request){

        // dd(Cart::count());
        

        $product = Product::with('product_images')->find($request->id);


 


        if($product->qty == 0){
            return response()->json([
                'status' => false,
                'message'=> 'The product is currently empty.'
            ]); 
        }


        if($product == null){
            return response()->json([
                'status' => false,
                'message'=> 'Product Not Found'
            ]);
        }

        if(Cart::count() > 0){
            $cartContant = Cart::content();
            $productAlreadyExist = false;

            foreach($cartContant as $item){
                if($item->id == $product->id){
                    $productAlreadyExist = true;
                }
            }

            if($productAlreadyExist == false){
                Cart::add($product->id, $product->title, 1,$product->price, [
                    'productImage'=> (!empty($product->product_images)) ? $product->product_images->first() : '' ]);
                $status = true;
                $message = '<strong>' . $product->title . '</strong> added in your cart successfully. ';
                $request->session()->flash(key: "success",value:$message);            
            }else{         
                $status = false;
                $message = $product->title . ' already added in cart';
            }
                                    
        }else{
            Cart::add($product->id, $product->title, 1,$product->price, ['productImage'=> (!empty($product->product_images)) ? $product->product_images->first() : '' ]);
            //card is Empty 
            $status = true;
            $message = '<strong>' . $product->title . '</strong> added in your cart successfully.';

            $request->session()->flash(key: "success",value:$message);            

        }
        
        return response()->json([
            'status'=> $status,
            'message'=> $message
        ]);
    }

    
    public function cart(){
        // json 
        // dd(Cart::content());
        $cartContant = Cart::content();
        $data['cartContant'] = $cartContant;
        return view('user.cart',$data);
    }

    public function deleteItem(Request $request){

        $itemInfo = Cart::get($request->rowId);

        if($itemInfo == null){
            $errorMessage = 'Item not Found in cart';
            $request->session()->flash(key: "error",value:$errorMessage);

            return response()->json([
                "status" => false,
                "message" => $errorMessage
            ]);
        }

        Cart::remove($request->rowId);

        $message = 'Item remove form cart successfully.';
        $request->session()->flash(key: "success",value:$message);

        return response()->json([
            "status" => true,
            "message" => $message
        ]);
    }



    public function updateCart(Request $request){

        // dd($request->all());


        $rowId = $request->rowId;
        $qty = $request->qty;

        $itemInfo = Cart::get($rowId);

        $product = Product::find($itemInfo->id);

        // check qty available in stock
        if($qty <= $product->qty){
            Cart::update($rowId, $qty);
            $message = "Cart Updated successfully";
            $status = true;
            $request->session()->flash("success",value:$message);
        } else {
            $message = "Request qty('$qty') not available in stock.";
            $status = false;
            $request->session()->flash(key: "error",value:$message);
        }

        return response()->json([
            "status" => $status,
            "message" => $message
        ]);

    }


    public function checkout(Request $request){

        // if caet is empty redirect to cart page
        if(Cart::count() == 0){
            return view("front.cart");
        }

        // if user is not logged in then redirect to login page
        if(Auth::check() == false){
            if(!session()->has("url.intended")){
                session(['url.intended' => url()->current()]);
            }  
            return redirect()->route('login');
        }

        $coustomer =  User::where('id',Auth::user()->id)->first();
        // session()->forget('url.intended');

        return view("user.checkout",compact('coustomer'));
    }


    // test 
    public function processCheckout(Request $request){
 
        $validator = Validator::make($request->all(), [
            "phone" => "required|min:10|numeric",
            "address" => "required|min:30",
        ]);
        
        
        if($validator->fails()){
            return response()->json([
                "errors"=> $validator->errors(),
                "status"=> false,
                "message"=> "Pleaase fix the errors"
            ]);
        } 
 
        $subTotal = Cart::subtotal(2,'.','');
        $user = Auth::user();


        $order = new Order();
        $order->subTotal = $subTotal;
        $order->user_id = $user->id;
        $order->mobile = $request->phone;
        $order->address = $request->address;
        $order->notes = $request->notes;
        $order->save();




        foreach(Cart::content() as $item){
            $orderItem = new OrderItem();
            $orderItem->product_id = $item->id;
            $orderItem->order_id = $order->id;
            $orderItem->name = $item->name;
            $orderItem->qty = $item->qty;
            $orderItem->price = $item->price;
            $orderItem->total = $item->price * $item->qty;
            $orderItem->save();




            $OrderCustomerQtyInProduct = $item->qty;

            // احصل على المنتج مباشرة
            $product = Product::find($item->id);

            if ($product) { // تأكد من أن المنتج موجود
                if ($OrderCustomerQtyInProduct <= $product->qty) {
                    // تقليل الكمية
                    $product->qty -= $OrderCustomerQtyInProduct;
                    $product->save();
                } else {
                    // إذا كانت الكمية المطلوبة أكبر من المتاحة، ضع الكمية بصفر لكن لا تحذفه
                    $OrderCustomerQtyInProduct -= $product->qty;
                    $product->qty = 0;
                    $product->save(); // تحديث المنتج بدلاً من حذفه
                }
            }
            
        }
 


    //         // send Order Emial
    //         orderEmail($order->id,'customer');
            

        Cart::destroy();
        session()->flash('success','Yor have successfully placed your order');

        return response()->json([
            "message" => "order saved successfully.",
            "status" => true,
            "orderId" => $order->id,
        ]);

    }
 
  


}

