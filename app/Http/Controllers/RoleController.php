<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PermissionRole;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->can('is-admin')){
            $roles = Role::all();
            $permissions = Permission::all();
            foreach($roles as $role){
                $role -> permissions;
            }
            return view('role.index',compact('roles','permissions'));
        }
        else{
            abort(403);
        }
        
    }

    public function store(Request $request)
    {
       

        $role = Role::create([
            'name' => $request->name
        ]);
        foreach($request->permission_id as $permission_id){
            PermissionRole::create(
                ['permission_id' => $permission_id, 'role_id' => $role->id],
            );
        }
        return redirect()->route('role.index');
    }
    
    public function update(Request $request, $id)
    {
        $role = Role::find($id);
        $role -> name = $request->name;
        $role -> save();
        PermissionRole::where('role_id',$id)->delete();
      
        foreach($request->permission_id as $permission_id){
            PermissionRole::create(
                ['permission_id' => $permission_id, 'role_id' => $role->id],
            );
        }
        return redirect()->route('role.index');
    }

    public function destroy( $id, Request $request)
    {
       
            $role = Role::find($id);
            $role->delete();
            return redirect()->route('role.index');
     
    }
    public function change_role( $id, Request $request)
    {
        // if($request->user()->can('change_role')){
        //     $user = User::find($id);
        //     return view('user.list');
        // }
        // else{
        //     abort(403);
        // }
    }
}
