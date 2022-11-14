<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // register
    public function registerPage(){
        return view('register');
    }

    // login
    public function loginPage(){
        return view('login');
    }

    // auth user role
    public function dashboard(){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('Category#list');
        }else{
            return redirect()->route('user#home');
        }
    }
}
