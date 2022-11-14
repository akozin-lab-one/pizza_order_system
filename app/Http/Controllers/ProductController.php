<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product direct list page
    public function productPage(){
        $products = Product::select('products.*','categories.name as category_name')
                    ->when(request('key'), function($query){
                            $query->where('products.name', 'like', '%'.request('key').'%');
                            })
                    ->leftjoin('categories', 'products.category_id', 'categories.id')
                    ->orderBy('products.id', 'desc')
                    ->paginate(4);
        return view('Admin.product.productList', compact('products'));
    }

    //  product create Page
    public function createPage(){
        $categories = Category::select('id', 'name')->get();
        return view('Admin.product.create', compact('categories'));
    }

    // create pizza
    public function createData(Request $request){
        $this->requestValidationData($request, "create");
        $data = $this->requestProductData($request);

        $fileName = uniqid() . $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public', $fileName);
        $data['image'] = $fileName;

        Product::create($data);
        return back()->with(['productCreateSuccess' => 'Your product is successfully created now!']);
    }

    // view pizza
    public function viewPizza($id){
        $pizza = Product::select('products.*', 'categories.name as category_name')
                ->where('products.id', $id)
                ->leftjoin('categories', 'products.category_id', 'categories.id')
                ->first();
        return view('Admin.product.detail', compact('pizza'));
    }

    // pizza delete
    public function deleteProduct($id){
        Product::where('id', $id)->delete();
        return back();
    }

    public function editDataPage($id){
        $product = Product::where('id', $id)->first();
        $categories = Category::select('id', 'name')->get();
        return view('Admin.product.edit', compact('product', 'categories'));
    }

    public function updateData(Request $request){
        $this->requestValidationData($request, "update");
        $data = $this->requestProductData($request);

        if ($request->hasFile('image')) {
            $dbImage = Product::where('id', $request->productId)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete(['public/' . $dbImage]);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/' , $fileName);
            $data['image'] = $fileName;
        }

        Product::where('id', $request->productId)->update($data);
        return redirect()->route('product#list');
    }

    // request validation data
    private function requestValidationData($request, $status){
        $validateRules = [
            'name' => 'required|min:6|unique:products,name,'. $request->productId,
            'category' => 'required',
            'description' => 'required|min:10',
            'waitingTime' => 'required',
            'price' => 'required'
        ];

        $validateRules['image'] = $status == "create" ? 'required|mimes:png,jpg,jpeg,webp|file' : 'mimes:png,jpg,jpeg,webp|file';
        Validator::make($request->all(), $validateRules )->validate();
    }

    // request product data
    private function requestProductData($request){
        return[
            'name' => $request->name,
            'category_id' => $request->category,
            'description' => $request->description,
            'waiting_time' => $request->waitingTime,
            'price' => $request->price
        ];
    }
}
