<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{
    //product list
    public function ProductList(){
        $products = Product::get();
        return response()->json($products, 200);
    }

    //category list
    public function CategoryList(){
        $categories = Category::get();
        return response()->json($categories, 200);
    }

    //create category
    public function CreateCategory(Request $request){
        $data = [
            'name' => $request->name,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];

        $response = Category::create($data);

        return response()->json($response, 200);
    }

    //delete category
    public function DeleteCategory($id){
        $data = Category::where('id', $id)->first();

        if (isset($data)) {
            Category::where('id', $id)->delete();
            return response()->json([   'status'=>'true',
                                        'message'=>'delete category success'], 200);
        }else{
            return response()->json([   'status'=>'false',
                                        'message' => 'Delete category not sucess.'], 500);
        }
    }

    //create contact
    public function CreateContact(Request $request){
        $data = $this->getContantData($request);

        Contact::create($data);

        $response = Contact::get();

        return response()->json($response, 200);
    }

    //update category
    public function CategoryDetail($id){
        $data = Category::where('id', $id)->first();
        if (isset($data)) {
            return response()->json([   'status'=>'true',
                                        'Category'=>$data], 200);
        }else{
            return response()->json([   'status'=>'false',
                                        'message' => 'there is no such category in the list'], 500);
        }
    }

    //update category data
    public function CategoryUpdate(Request $request){
        $dbSource = Category::where('id', $request->category_id)->first();

        if (isset($dbSource)) {
            $data = $this->getCategoryData($request);
            Category::where('id', $request->category_id)->update($data);
            $response = Category::where('id', $request->category_id)->first();
            return response()->json(['status'=>'true', 'category'=>$response], 200);
        }else{
            return response()->json(['status'=>'False', 'message'=> 'Update Category not success'], 500);
        }
    }

    //request category data
    private function getCategoryData($request){
        return [
            'name' => $request->category_name,
            'updated_at' => Carbon::now()
        ];
    }

    private function getContantData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
    }


}
