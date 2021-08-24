<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index (Request $request){
        if($request->user()->can('view_department')){
            $departments = Department::all();
            $branches = Branch::all();
            return view('departments.index',compact('departments','branches'));
        }
        else
            return redirect()->back();
        
    }
    public function show (Request $request,$id){
    }

    public function store(Request $request)
    {
        $department = new Department();
        $department->branch_id = $request->branch_id;
        $department->department_code = $request->department_code;
        $department->name = $request->name;
        $department->note = $request->note;
        $department -> save();
        return redirect()->route('department.index');
    }
    public function update(Request $request, $id)
    {
        $department = Department::find($id);
        $department->branch_id = $request->branch_id;
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
