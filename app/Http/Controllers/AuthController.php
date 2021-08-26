<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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
            if($userInfo->status){
                //check password
                if(Hash::check($request->password, $userInfo->password)) {
                    $request->session()->put('LoggedUser', $userInfo->id);
                    Auth::attempt(['username'=>$request->username,'password'=>$request->password]);
                    return redirect('/dashboard');

                }else{
                    return back()->with('fail', 'Incorrect password!');
                }
            }
            else{
                return back()->with('fail', 'Your account was blocked');
            }
            
        }
    }

    public function profile(Request $request) {
        $user = $request->user();
        $userInfo = ['LoggedUserInfo' => User::where('id', session('LoggedUser'))->first()];
        Session::put('userInfo', $userInfo);
        return view('profile.index',compact('user','userInfo'));
    }

    public function profileUpdate(Request $request, $id) {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->note = $request->note;
        if($request->password) {
            $user->password = Hash::make($request->password);
        }

        if($request->file) {
            $extension = $request->file->extension();
            $file_path = Str::slug($request->name, '-').'_'.time().'.'.$extension;
            $user->image = $request->getSchemeAndHttpHost().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'user_avt'.DIRECTORY_SEPARATOR.$file_path;
            $request->file->move($path = public_path(). DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'user_avt'.DIRECTORY_SEPARATOR, $file_path);
        }
        $save = $user->save();

        if($save) {
           
            return redirect()->route('profile')->with('success', 'Saved');
        }
        else {
            return redirect()->route('profile')->with('fail', 'Something went wrong, try again!');
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
        $userInfo = ['LoggedUserInfo' => User::where('id', session('LoggedUser'))->first()];
        Session::put('userInfo', $userInfo);
        return view('dashboard.index', $userInfo);
    }
}