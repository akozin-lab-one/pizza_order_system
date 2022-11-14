<?php

namespace App\Http\Controllers\user;

use Storage;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user list page
    public function list(){
        $users = User::where('role', 'user')->get();
        return view('Admin.user.userList', compact('users'));
    }

    //user detail page
    public function Detail($id){
        $user = User::where('id', $id)->where('role', 'user')->first();
        return view('Admin.user.userDetail', compact('user'));
    }

    //user change role
    public function ChangeRole(Request $request){
        $updateSource = [
            'role' => $request->role,
        ];
        User::where('id', $request->userId)->update($updateSource);
    }

    //change gender
    public function ChangeGender(Request $request){
        $updateSource = [
            'gender' => $request->gender,
        ];
        User::where('id', $request->userId)->update($updateSource);
    }

    //contact message
    public function ContactMessage(){
        return view('User.main.contact.contact');
    }

    //user home page
    public function userHomePage(){
        $pizzas = Product::orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cartData = Cart::where('user_id', Auth::user()->id)->get();
        $orderhistory = Order::where('user_id', Auth::user()->id)->paginate('5');
        return view('User.main.home', compact('pizzas', 'category', 'cartData', 'orderhistory'));
    }

    //filter pizza
    public function filterPage($categoryId){
        $pizzas = Product::where('category_id', $categoryId)->orderBy('created_at', 'desc')->get();
        $category = Category::get();
        $cartData = Cart::where('user_id', Auth::user()->id)->get();
        $orderhistory = Order::where('user_id', Auth::user()->id)->paginate('5');
        return view('User.main.home', compact('pizzas', 'category', 'cartData', 'orderhistory'));
    }

    // user account passwrod change Page
    public function passwordChangePage(){
        return view('User.password.password');
    }

    // useraccountdetail
    public function detailPage(){
        return view('User.account.detail');
    }

    //delete user list
    public function DeleteUser($id){
        User::where('role', 'user')->delete();
        return back();
    }

    public function pizzaDetailPage($pizzaId){
        $pizza = Product::where('id', $pizzaId)->first();
        $pizzaList = Product::get();
        return view('User.main.pizza.detail', compact('pizza', 'pizzaList'));
    }

    public function pizzaCartList(){
        $cartList = Cart::select('carts.*', 'products.name as pizza_name', 'products.price as pizza_price', 'products.image as pizza_image')
                        ->leftJoin('products', 'products.id', 'carts.product_id')
                        ->where('user_id', Auth::user()->id)
                        ->get();
        $totalPrice = 0;
        foreach ($cartList as $c) {
            $totalPrice += $c->pizza_price * $c->qty;
        }

        return view('User.main.pizza.cart', compact('cartList', 'totalPrice'));
    }

    public function History(){
        $orderhistory = Order::where('user_id', Auth::user()->id)->paginate('5');
        return view('User.main.pizza.history', compact('orderhistory'));
    }

    // account data update
    public function userAccountChange($id, Request $request){
        $this->validationAccount($request);
        $data = $this->requestAccountData($request);

        if ($request->hasFile('image')) {
            $dbImage = User::where('id', $id)->first();
            $dbImage = $dbImage->image;

            if ($dbImage != null) {
                Storage::delete(['public/' . $dbImage]);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }

        Auth::user()->where('id', $id)->update($data);
        return redirect()->route('user#detail')->with(['updateSuccess' => 'Your Account Information is successfullly update!']);
    }

    // user account passwrod change
    public function passwordChange(Request $request){
        $this->validatePasswordCheck($request);
        $user = Auth::user()->where('id', $request->userId)->select('password', 'name')->first();
        $dbPassword = $user->password;

        if (Hash::check($request->oldPassword, $dbPassword)) {
            $data = [
                'password' => Hash::make($request->oldPassword)
            ];

            Auth::user()->where('id', Auth::user()->id)->update($data);
        }
        return back()->with(['passwordchangesuccess' => 'Your Password is successfully changed!']);
    }

    // request account data
    public function requestAccountData($request){
        return[
            'name' => $request->name,
            'email' => $request->email,
            'gender' => $request->gender,
            'phone' => $request->phone,
            'address' => $request->address
        ];
    }

    // validation account data
    private function validationAccount($request){
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'image' => 'mimes:png,jpg,jpeg|file',
            'address' => 'required'
        ])->validate();
    }


    // passwordvalidation
    private function validatePasswordCheck($request){
        Validator::make($request->all(), [
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ])->validate();
    }

}
