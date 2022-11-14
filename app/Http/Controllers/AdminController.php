<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    // detailPage
    public function detailPage(){
        return view('Admin.account.detail');
    }

    // edit account detail
    public function editAccountPage(){
        return view('Admin.account.editAccountDetail');
    }

    public function accountList(){
        $admins = User::when(request('key'), function($query){
                    $query->orwhere('name', 'like', '%'.request('key').'%')
                          ->orwhere('email', 'like', '%'.request('key').'%')
                          ->orwhere('gender', 'like', '%'.request('key').'%')
                          ->orwhere('phone', 'like', '%'.request('key').'%')
                          ->orwhere('address', 'like', '%'.request('key').'%');
                    })
                    ->where('role', 'admin')
                    ->paginate(3);
        return view('Admin.account.accountlist', compact('admins'));
    }

    //role ajax change
    public function RoleChange(Request $request){
        $updateSource = [
            'role' => $request->role
        ];
        User::where('role', 'admin')->where('id',$request->userId)->update($updateSource);
    }

    //account role
    public function accountRole($id){
        $account = User::where('id', $id)->first();
        return view('Admin.account.accountRoleChange', compact('account'));
    }

    // account changerole
    public function ChangeRole($id,Request $request){
        $data = $this->requestAccountRole($request);
        User::where('id', $id)->update($data);
        return redirect()->route('auth#accountlist');
    }

    // account delete
    public function accountDelete($id){
        User::where('id', $id)->delete();
        return back()->with(['deleteSuccess' => 'Account is successfully deleted....']);
    }

    // account data update
    public function updateAccountData($id, Request $request){
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
        return redirect()->route('auth#detail')->with(['updateSuccess' => 'Your Account Information is successfullly update!']);
    }

    // change password page
    public function changePassword(){
        return view('Admin.account.changePassword');
    }

    // change password
    public function passwordchange(Request $request){
        $this->validatePasswordCheck($request);
        $user = Auth::user()->select('password')->first();
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

    // request account role
    private function requestAccountRole($request){
        return[
            'role' => $request->role
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
