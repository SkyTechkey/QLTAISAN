<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->can('is-admin')){
           
            $permissions = Permission::all();
           
            return view('permission.index',compact('permissions'));
        }
        else{
            abort(403);
        }
        
    }

    public function store(Request $request)
    {
       
        if($request->user()->can('is-admin')){
           
            $permission = Permission::create([
                'name' => $request->name
            ]);
            return redirect()->route('permission.index');
        }
        else{
            abort(403);
        }

        
    }
    
    public function update(Request $request, $id)
    {
        
        if($request->user()->can('is-admin')){
            $permission = Permission::find($id);
            $permission -> name = $request->name;
            $permission -> save();

        return redirect()->route('permission.index');
        }
        else{
            abort(403);
        }
       
    }

    public function destroy( $id, Request $request)
    {
       
        if($request->user()->can('is-admin')){
           
            $permission = Permission::find($id);
            $permission->delete();
            return redirect()->route('permission.index');
        }
        else{
            abort(403);
        }
          
     
    }
}
