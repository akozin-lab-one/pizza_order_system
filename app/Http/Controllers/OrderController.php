<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderList;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //order list
    public function orderList(){
        $orders = Order::when(request('key'), function($query){
                        $query->orwhere('name', 'like', '%'.request('key').'%');
                        $query->orwhere('order_code', 'like', '%'.request('key').'%');
                        // $query->orwhere('created_at', 'like', '%'.request('key').'%');
                    })
                    ->select('orders.*', 'users.name as user_name')
                    ->orderBy('created_at', 'desc')
                    ->leftJoin('users', 'users.id', 'orders.user_id')
                    ->paginate('6');
        return view('Admin.order.order', compact('orders'));
    }

    // order ajax js
    public function OrderStatus(Request $request){
        $orders = Order::when(request('key'), function($query){
            $query->orwhere('name', 'like', '%'.request('key').'%');
            $query->orwhere('order_code', 'like', '%'.request('key').'%');
            $query->orwhere('status', 'like', '%'.request('key').'%');
                })
                ->select('orders.*', 'users.name as user_name')
                ->orderBy('created_at', 'desc')
                ->leftJoin('users', 'users.id', 'orders.user_id');


        if ($request->orderStatus == null) {
            $orders = $orders->get();
        }else{
            $orders = $orders->orwhere('orders.status', $request->orderStatus)->get();
        }

        return view('Admin.order.order', compact('orders'));
    }

    //order status change
    public function OrderStatusChange(Request $request){
        Order::where('id', $request->orderId)->update([
            'status' => $request->status,
        ]);
    }

    //order detail list

    public function OrderDetailList($ordercode){
        $order = Order::where('order_code', $ordercode)->first();
        $orderlists = OrderList::select('order_lists.*', 'users.name as user_name', 'products.image as product_image', 'products.name as product_name')
                    ->leftJoin('users', 'users.id', 'order_lists.user_id')
                    ->leftJoin('products', 'products.id', 'order_lists.product_id')
                    ->where('order_code', $ordercode)
                    ->get();
        return view('Admin.order.orderDetail', compact('orderlists', 'order'));
    }
}
