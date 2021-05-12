<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class userController extends Controller
{
    public function showLogin(){
        return view('pages.login');
    }

    public function showRegister(){
        return view('pages.register');
    }

    public function doRegister(Request $request){
        $validated = $request->validate([
            'firstName' => 'required|string|max:30',
            'lastName' => 'required|string|max:20',
            'email' => 'required|email:rfc,dns|max:255',
            'phoneNumber' => 'required|string|max:20|min:10',
            'password' => 'required|string|max:100|min:8',
            'rePassword' => 'required|same:password|string|min:8|max:100',
        ]);
        return view('pages.index');
    }
}