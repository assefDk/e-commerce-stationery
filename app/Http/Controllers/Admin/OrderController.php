<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index(Request $request){

        $orders = Order::latest('orders.created_at')->select('orders.*','users.name','users.email'); 
        $orders = $orders->leftJoin('users','users.id','orders.user_id');

        if($request->get('Keyword') != ""){
            $orders = $orders->where('users.name','%'.$request->Keyword.'%');
            $orders = $orders->orWhere('users.email','%'.$request->Keyword.'%');
            $orders = $orders->orWhere('orders.id','%'.$request->Keyword.'%');
        }

        $orders = $orders->paginate(10); 

        return view('admin.orders.list',[
            'orders' => $orders 
        ]);

    }



    public function detail($orderId) {

        $order = Order::with('user')->where('id', $orderId)->firstOrFail();
        
        $orderItems = OrderItem::where('order_id', $orderId)->get(); 
    
        return view('admin.orders.detail', [
            'order' => $order,
            'orderItems' => $orderItems 
        ]);
    }







}
