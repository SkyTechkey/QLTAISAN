<?php

namespace App\Http\Controllers;

use App\Models\branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->can('view_all_branch')){
            $branches = branch::all();
            return view('branch.index',compact('branches'));
        }
        else if($request->user()->can('view_branch')){
            $branches = branch::where('id',$request->user()->department->branch->id)->get();
            return view('branch.index',compact('branches'));
        }
        else
           return redirect()->back();
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $branch = branch::find($id);
        $branch->name = $request->name;
        $branch->email = $request->email;
        $branch->address = $request->address;
        $branch->phone = $request->phone;
        $branch->unit_id = $request->unit_id;
        $branch->note = $request->note;
        $branch -> save();
        return redirect()->route('branch.index');
    }

    public function destroy($id)
    {
        //
    }
}
