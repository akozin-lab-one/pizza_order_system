<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    //list page
    public function shopListPage(){
        $shops = Shop::select('*')
                ->orderBy('shops.id', 'asc')
                ->paginate(4);
        return view('Admin.shop.list', compact('shops'));
    }

    //create shop page
    public function shopCreatePage(){
        $shopCreate = Shop::select('id', 'name')->get();
        return view('Admin.shop.create', compact('shopCreate'));
    }

    // create shop
    public function createShop(Request $request){
        $this->requestValidationData($request);
        $data = $this->requestShopData($request);

        Shop::create($data);
        return back()->with(['shopCreateSuccess'=>"Your Shop is in the List Now!"]);
    }

    //detail shop
    public function detailShop($id){
        $shop = Shop::select('*')
                ->where('shops.id', $id)
                ->first();
        return view('Admin.shop.detail', compact('shop'));
    }

    //edit shop page
    public function editShopPage($id){
        $editShop = Shop::select('*')
                    ->where('shops.id', $id)
                    ->first();
        return view('Admin.shop.edit', compact('editShop'));
    }

    //edit shop
    public function editShop(Request $request){
        $this->requestValidationData($request);
        $data = $this->requestShopData($request);

        Shop::where('id', $request->shopId)->update($data);
        return redirect()->route('Shop#List');
    }

    //validation check
    private function requestValidationData($request){
        $validate = [
            'name'=>'required|min:6',
            'address' => 'required' ,
            'employee' => 'required'
        ];
        Validator::make($request->all(), $validate)->validate();
    }

    //validate shop data
    private function requestShopData($request){
        return[
            'name' => $request->name,
            'address' => $request->address,
            'employee' => $request->employee
        ];
    }
}
