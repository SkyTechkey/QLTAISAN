<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index (Request $request){
        if($request->user()->can('is-admin')){
            $departments = Department::all();
            foreach ($departments as $department){
                $department->user;
            }
            return view('department.list',compact('departments'));
        }
        else
            abort(403);
        
    }
    public function show (Request $request,$id){
        $department = Department::find($id);
        // gọi hàm view ở policy để check
        if($request->user()->can('is-admin')){
            return view('department.show', compact('department'));
        }
        else{
            abort(403);
        }
        
    }
    public function create(Request $request){
        if($request->user()->can('is-admin')){
            return view('department.create');
        }
        else{
            abort(403);
        }
        
    }
    public function edit(Request $request,$id)
    {
        if($request->user()->can('is-admin')){
            $department = Department::find($id);
            return view('department.edit', compact('department'));
        }
        else{
            abort(403);
        }
    }

    public function store(Request $request)
    {
        $department = new Department();
        $department->department_code = $request->department_code;
        $department->name = $request->name;
        $department->note = $request->note;
        $department -> save();
        return redirect()->route('department.index');
    }
    public function update(Request $request, $id)
    {
        $department = Department::find($id);
        $department->department_code = $request->department_code;
        $department->name = $request->name;
        $department->note = $request->note;
        $department -> save();
        return redirect()->route('department.index');
    }

    public function destroy($id)
    {
       
            $department = Department::find($id);
            $department -> delete();
            return redirect()->route('department.index');
    }
}
