<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //ajax pizza list
    public function AjaxList(Request $request){
        logger($request);
        if($request->status == 'asc'){
            $data = Product::orderBy('created_at', 'asc')->get();
        }else if($request->status == 'desc'){
            $data = Product::orderBy('created_at', 'desc')->get();
        }else{
            $data = Product::get();
        }
        return $data;
    }

    // ajax pizza cart
    public function AddToCart(Request $request){
        $data = $this->getOrderData($request);
        Cart::create($data);
        $response= [
            'message'=>'Add To Cart Complete',
            'status'=>'success'
        ];
        return response()->json($response,200);
    }

    public function OrderList(Request $request){
        foreach ($request->all() as $item) {
            $total = 0;
            $data = OrderList::create([
                'user_id' => $item['user_id'],
                'product_id' => $item['product_id'],
                'qty' => $item['qty'],
                'total' => $item['total'],
                'order_code' => $item['order_code'],
            ]);
            $total += $data->total;
        }

        Cart::where('user_id', Auth::user()->id)->delete();

        Order::create([
            'user_id' => $data->user_id,
            'order_code' => $data->order_code,
            'total_price' => $total + 3000,
        ]);

        return response()->json([
            'status' => 'true',
            'message'=>'order completed'
        ], 200);
    }

    //clear cart
    public function Clearcart(){
        Cart::where('user_id', Auth::user()->id)->delete();
    }

    //clear product cart list
    public function ClearProduct(Request $request){
        Cart::where('user_id', Auth::user()->id)
                ->where('id', $request->orderId)
                ->where('product_id', $request->productId)
                ->delete();
    }

    //view count
    public function ViewCount(Request $request){
        $pizza = Product::where('id', $request->pizzaId)->first();

        $updateSource = [
            'view_count' => $pizza->view_count + 1,
        ];

        logger($updateSource);
        Product::where('id', $request->pizzaId)->update($updateSource);
    }

    //contact message
    public function ContactMe(Request $request){
        $updateSource = [
            'name' => $request->userName,
            'email' => $request->userEmail,
            'message' => $request->userMessage,
        ];
        Contact::create($updateSource);
    }

    // get order data
    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
