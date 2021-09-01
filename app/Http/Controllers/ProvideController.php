<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Provide;

class ProvideController extends Controller
{
    public function index(Request $request)
    {
        if($request->user()->can('is-admin')){
           
            $provide = Provide::all();
            return view('provide.index',compact('provide'));
        }
        else{
            abort(403);
        }
       
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|max:255|unique:provide',
            'name'=>'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:12|unique:provide',
        ]);

        $provide = new Provide();
        $provide->code = $request->code;
        $provide->name = $request->name;
        $provide->phone = $request->phone;
        $provide->address = $request->address;
        $save = $provide->save();

        if($save){
            return back()->with('success', 'Hành động thực hiện thành công');
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
            'code' => 'required|max:255',
            'name' => 'required|max:255',
            'address' => 'required|max:255',
            'phone' => 'required|max:12',
           
        ]);
        $provide = Provide::find($id);
        $provide->name = $request->name;
        $provide->code = $request->code;
        $provide->address = $request->address;
        $provide->phone = $request->phone;
        $save = $provide->save();

        if($save){
            return back()->with('success', 'Hành động thực hiện thành công');
        }else{
            return back()->with('fail','Something went wrong, try again!');
        }
    }

    public function destroy($id)
    {
        $provide = Provide::find($id);
        $provide -> delete();
        return redirect()->route('provide.index');
    }
}
