<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login() {
        return view('login.index');
    }

    function onLogin(Request $request) {
        //validate requests
        $request->validate([
             'username'=>'required',
             'password'=>'required|min:5'
        ]);

        // check username
        $userInfo = User::where('username', $request->username)->first();

        if(!$userInfo){
            return back()->with('fail','We do not recognize your username!');
        }else{
            //check password
            if(Hash::check($request->password, $userInfo->password)) {
                $request->session()->put('LoggedUser', $userInfo->id);
                Auth::attempt(['username'=>$request->username,'password'=>$request->password]);
                return redirect('/dashboard');

            }else{
                return back()->with('fail', 'Incorrect password!');
            }
        }
    }

    function logout() {
        // handle logout
        if(session()->has('LoggedUser')){
            Auth::logout();
            session()->pull('LoggedUser');
            return redirect('/login');
        }
    }

    function dashboard() {
        // return dashboard page with Logged in User Info
        $data = ['LoggedUserInfo' => User::where('id', session('LoggedUser'))->first()];
        return view('dashboard.index', $data);
    }
}