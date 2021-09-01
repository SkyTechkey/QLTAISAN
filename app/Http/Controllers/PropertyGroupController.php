<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property_group;
use Illuminate\Support\Str;
class PropertyGroupController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->can('is-admin')){
            $property_group = Property_group::all();
            return view('property_group.index',compact('property_group'));
        }
        else{
            abort(403);
        }
       
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:4|unique:property_group',
            'note' => 'required',
        ]);

        $property_group = new Property_group();
        $property_group->code = Str::upper($request->code);
        $property_group->name = $request->name;
        $property_group->note = $request->note;
        $save = $property_group->save();

        if($save){
            return back()->with('success','New property_group has been successfuly added to database');
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
            'note' => 'required',
            'code' => 'required|max:4',
           
        ]);
        $property_group = Property_group::find($id);
        $property_group->code = Str::upper($request->code);
        $property_group->name = $request->name;
        $property_group->note = $request->note;
       
        $save = $property_group->save();

        if($save){
            return back()->with('success','New property_group has been successfuly added to database');
        }else{
            return back()->with('fail','Something went wrong, try again!');
        }
    }

    public function destroy($id)
    {
        $property_group = Property_group::find($id);
        $property_group -> delete();
        return redirect()->route('property_group.index');
    }
}