<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashbordController extends Controller
{
    public function dashbord(){

        $data = [];
        $totalOrders = Order::count();
        $totalCustomers = User::where('role','user')->count();
        $totalRevenue = Order::sum('subTotal');





        $lastMonthStartDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
        $lastMonthEndDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d') ;
        $lastMonthName = Carbon::now()->subMonth()->startOfMonth()->format('M');
        
        $revenueLastMonth = Order::whereDate('created_at','>=',$lastMonthStartDate)
                            ->whereDate('created_at','<=',$lastMonthEndDate)
                            ->sum('subTotal');






        // This month revenue 
        $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
        $currentDate = Carbon::now()->format('Y-m-d');
        
        $revenueThisMonth = Order:: whereDate('created_at','>=',$startOfMonth)
                            ->whereDate('created_at','<=',$currentDate)
                            ->sum('subTotal');
        
        









        // This 30 days sale
        $lastThirtyDayStartDate = Carbon::now()->subDays(30)->format('Y-m-d');
        
        $revenueLastThirtyDays = Order::whereDate('created_at','>=',$lastThirtyDayStartDate)
                            ->whereDate('created_at','<=',$currentDate)
                            ->sum('subTotal');
 






        $data['totalOrders'] = $totalOrders;
        $data['totalCustomers'] = $totalCustomers;
        $data['totalRevenue'] = $totalRevenue;
        $data['revenueLastMonth'] = $revenueLastMonth;
        $data['revenueLastThirtyDays'] = $revenueLastThirtyDays;
        $data['revenueThisMonth'] = $revenueThisMonth;
    
        return view('admin.dashbord', $data);
    }

 
    // public function index(){

    //     $totalOrders = Order::where('status','!=','cancelled')->count();
    //     $totalProducts = Product::count();
    //     $totalCustomers = User::where('role',1)->count();


    //     $totalRevenue = Order::where('status','!=','cancelled')->sum('grand_total');
 
    //     // This month revenue 
    //     $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
    //     $currentDate = Carbon::now()->format('Y-m-d');
        
    //     $revenueThisMonth = Order::where('status','!=','cancelled')
    //     ->whereDate('created_at','>=',$startOfMonth)
    //     ->whereDate('created_at','<=',$currentDate)
    //     ->sum('grand_total');
        
        





    //     // This last revenue 
    //     $lastMonthStartDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
    //     $lastMonthEndDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d') ;
    //     $lastMonthName = Carbon::now()->subMonth()->startOfMonth()->format('M');
        
    //     $revenueLastMonth = Order::where('status','!=','cancelled')
    //                         ->whereDate('created_at','>=',$lastMonthStartDate)
    //                         ->whereDate('created_at','<=',$lastMonthEndDate)
    //                         ->sum('grand_total');

                         
    //     // This 30 days sale
    //     $lastThirtyDayStartDate = Carbon::now()->subDays(30)->format('Y-m-d');
        
    //     $revenueLastThirtyDays = Order::where('status','!=','cancelled')
    //                         ->whereDate('created_at','>=',$lastThirtyDayStartDate)
    //                         ->whereDate('created_at','<=',$currentDate)
    //                         ->sum('grand_total');
 


    //     return view("admin.dachboard",[
    //         'totalOrders' => $totalOrders,
    //         'totalProducts' => $totalProducts,
    //         'totalCustomers' => $totalCustomers,
    //         'totalRevenue' => $totalRevenue,
    //         'revenueThisMonth' => $revenueThisMonth,
    //         'revenueLastMonth' => $revenueLastMonth,
    //         'lastMonthName' => $lastMonthName,
    //         'revenueLastThirtyDays' => $revenueLastThirtyDays
    //     ]);
    // }




}
