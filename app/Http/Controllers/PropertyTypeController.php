<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Property_type;

class PropertyTypeController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->can('is-admin')){
            $property_type = Property_type::all();
            return view('property_type.index',compact('property_type'));
        }
        else{
            abort(403);
        }
       
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'note' => 'required',
        ]);

        $property_type = new Property_type();
        $property_type->property_name = $request->name;
        $property_type->note = $request->note;
        $save = $property_type->save();

        if($save){
            return back()->with('success','New property_type has been successfuly added to database');
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
           
        ]);
        $property_type = Property_type::find($id);
        $property_type->property_name = $request->name;
        $property_type->note = $request->note;
       
        $save = $property_type->save();

        if($save){
            return back()->with('success','New property_type has been successfuly added to database');
        }else{
            return back()->with('fail','Something went wrong, try again!');
        }
    }

    public function destroy($id)
    {
        $property_type = Property_type::find($id);
        $property_type -> delete();
        return redirect()->route('property_type.index');
    }
}
