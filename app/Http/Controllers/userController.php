<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\user;
use Illuminate\Support\Facades\Hash;
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
            'email' => 'required|email:rfc,dns|max:255|unique:user,gmail',
            'phoneNumber' => 'required|string|max:20|min:10',
            'password' => 'required|string|max:100|min:8',
            'rePassword' => 'required|same:password|string|min:8|max:100',
        ]);

        $user = new user;
        $user->gmail = $request->email;
        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->phone_number = $request->phoneNumber;
        $user->password = hash::make($request->password);
        $user->save();
        
        return view("pages.login");
        
    }
    public function doLogin(Request $request){
        $validated = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|max:100|min:8',
        ]);
        $user = new user;
        $user = user::where('gmail', '=', $request->email)->first();
        if($user !=null)
        {
            $username = $user->first_name.$user->last_name;
            if(Hash::check($request->password, $user->password))
                    return redirect('/')->with('username',$username);
                else 
                    return redirect('/login')->with('warm', 'Mật khẩu không đúng');
        }else{
            return redirect('/login')->with('warm', 'Tài khoản chưa đăng kí');
        }
    }

    public function doLogout(Request $request){
        $request->session()->forget('username');
        return view("pages.index");
        
    }
}