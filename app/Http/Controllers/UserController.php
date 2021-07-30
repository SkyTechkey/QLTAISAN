<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   
    public function index()
    {
        $users = User::all();
        return view('user.list',compact('users'));
    }

    public function create(Request $request)
    {
        if($request->user()->can('create_user')){
            return view('user.create');
        }
        else{
            abort(403);
        }
        
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);
        // gọi hàm view ở policy để check
        if($request->user()->can('view_user',$user)){
            return view('user.show', compact('user'));
        }
        else{
            abort(403);
        }
    }

    public function edit(Request $request, $id)
    {
        if($request->user()->can('update_user')){
            $user = User::find($id);
            return view('user.edit', compact('user'));
        }
        else{
            abort(403);
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy( $id, Request $request)
    {
        if($request->user()->can('delete_user')){
            $user = User::find($id);
            $user->delete();
            return view('user.list');
        }
        else{
            abort(403);
        }
    }
    public function change_role( $id, Request $request)
    {
        if($request->user()->can('change_role')){
            $user = User::find($id);
            return view('user.list');
        }
        else{
            abort(403);
        }
    }
}
