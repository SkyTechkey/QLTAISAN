<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class DepartmentController extends Controller
{
    public function index (Request $request){
        if($request->user()->can('view_department')){
            $departments = Department::all();
            $branches = Branch::all();
            return view('departments.index',compact('departments', 'branches'));
        }
        else
            return redirect()->back();
        
    }
    public function show (Request $request,$id){
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_code' => 'required|max:20',
            'name' => 'required|max:50',
        ]);
        $department = new Department();
        $department->branch_id = $request->branch_id;
        $department->department_code = $request->department_code;
        $department->name = $request->name;
        $department->note = $request->note;
        $save = $department -> save();
        if($save){
           return redirect()->route('department.index')->with('success', 'Hành động thực hiện thành công');
        }else{
           return redirect()->route('department.index')->with('fail','Something went wrong, try again!');
        }
        
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'department_code' => 'required|max:20',
            'name' => 'required|max:50',
        ]);
        $department = Department::find($id);
        $department->branch_id = $request->branch_id;
        $department->department_code = $request->department_code;
        $department->name = $request->name;
        $department->note = $request->note;
        $save = $department -> save();
        if($save){
           return redirect()->route('department.index')->with('success', 'Hành động thực hiện thành công');
        }else{
           return redirect()->route('department.index')->with('fail','Something went wrong, try again!');
        }
    }

    public function destroy($id)
    {
        // ?
        $department = Department::find($id);
        $department -> delete();
        return redirect()->route('department.index');
    }

    public function getDepartments($branch_id) {
        if($branch_id == 0) {
            $departs = Department::all();
        }
        else {
            $departs = Department::where('branch_id', $branch_id)->get();
        }

        foreach($departs as $depart) {
            $depart->branch_name = $depart->branch->name;
            $depart->numOfUser = $depart->user->count();
        }

        return $departs;
    }
}
