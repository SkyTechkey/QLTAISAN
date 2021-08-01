<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
   
    public function index(Request $request)
    {
        if($request->user()->can('view_user')){
            $users = User::all();
            $departments = Department::all();
            $roles = Role::all();
            foreach($users as $user){
                $user -> department;
                $user -> roles;
            }
            return view('user.list',compact('users','departments','roles'));
        }
        else{
            abort(403);
        }
        
    }

    public function create(Request $request)
    {
      
        if($request->user()->can('create_user')){
            return view('user.create',compact('departments'));
        }
        else{
            abort(403);
        }
        
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'department_id' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department_id' => $request->department_id,
        ]);
        foreach($request->role_id as $role_id){
            RoleUser::create(
                ['role_id' => $role_id, 'user_id' => $user->id],
            );
        }
        return redirect()->route('user.index');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::find($id);
        $user -> name = $request->name;
        $user -> email = $request->email;
        $user -> password = Hash::make($request->password);
        $user -> department_id = $request->department_id;
        $user -> save();
       
        $roleuser = RoleUser::where('user_id',$id)->delete();
      
        foreach($request->role_id as $role_id){
            RoleUser::create(
                ['role_id' => $role_id, 'user_id' => $user->id],
            );
        }
     

        return redirect()->route('user.index');
    }

    public function destroy( $id, Request $request)
    {
        if($request->user()->can('delete_user')){
            $user = User::find($id);
            $user->delete();
            return redirect()->route('user.index');
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
