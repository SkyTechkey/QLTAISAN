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
       
            $users = User::all();
            $departments = Department::all();
            $roles = Role::all();
            // return view('user.list',compact('users','departments','roles'));
            return $users;
        
    }

    public function create(Request $request)
    {
        return 'view create';
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255|unique:users',
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        //     'department_id' => 'required'
        // ]);

        // $user = User::create([
        //     'name' => $request->name,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        //     'department_id' => $request->department_id,
        // ]);
        // foreach($request->role_id as $role_id){
        //     RoleUser::create(
        //         ['role_id' => $role_id, 'user_id' => $user->id],
        //     );
        // }
        // return redirect()->route('user.index');
        return 'stored';
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);
        return $user;
    }

    public function edit(Request $request, $id)
    {
       return 'view edit';
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255',
        //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
        // ]);

        // $user = User::find($id);
        // $user -> name = $request->name;
        // $user -> email = $request->email;
        // $user -> password = Hash::make($request->password);
        // $user -> department_id = $request->department_id;
        // $user -> save();
       
        // $roleuser = RoleUser::where('user_id',$id)->delete();
      
        // foreach($request->role_id as $role_id){
        //     RoleUser::create(
        //         ['role_id' => $role_id, 'user_id' => $user->id],
        //     );
        // }
            return ('updated');
    }

    public function destroy( $id, Request $request)
    {
      
            // $user = User::find($id);
            // $user->delete();
           return ('deleted');
    }
}
