<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->can('view_all_branch')){
            $branches = Branch::all();
            return view('branches.index',compact('branches'));
        }
        else if($request->user()->can('view_branch')){
            $branches = Branch::where('id',$request->user()->department->branch->id)->get();
            // dd($request->user()->can('view_branch'));
            return view('branches.index',compact('branches'));
        }
        else
           return redirect()->back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:12|unique:branches',
            'email' => 'required|email|max:255|unique:branches',
        ]);

        $branch = new Branch;
        $branch->name = $request->name;
        $branch->email = $request->email;
        $branch->address = $request->address;
        $branch->phone = $request->phone;
        $branch->unit_id = $request->unit_id;
        $branch->note = $request->note;
        $save = $branch->save();

        if($save){
            return back()->with('success','New Branch has been successfuly added to database');
        }else{
            return back()->with('fail','Something went wrong, try again!');
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:12',
            'email' => 'required|email|max:255',
        ]);
        $branch = Branch::find($id);
        $branch->name = $request->name;
        $branch->email = $request->email;
        $branch->address = $request->address;
        $branch->phone = $request->phone;
        $branch->unit_id = $request->unit_id;
        $branch->note = $request->note;
        $save = $branch->save();

        if($save){
            return back()->with('success','New Branch has been successfuly added to database');
        }else{
            return back()->with('fail','Something went wrong, try again!');
        }
    }

    public function destroy($id)
    {
        $branch = Branch::find($id);
        $branch -> delete();
        return redirect()->route('branch.index');
    }
}
