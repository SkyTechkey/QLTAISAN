<?php

namespace App\Http\Controllers;

use App\Models\unit;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UnitController extends Controller
{
   
    public function index(Request $request)
    {
        if($request->user()->can('is-admin') || $request->user()->can('view_unit')){
            $units = unit::find(1);
            return view('unit.index',compact('units'));
            // return $units;
        }
        else
            return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        if($request->user()->can('update_unit')){
            
        $file = $request->file;
        if($file) {
            $date = now();
            $date = $date->format('d-m-Y-H-i-s');
            $filename = $file->getClientOriginalName();
            $newImageName = Str::of($filename)->explode('.')[0];
            $extension = $file->extension();

            $file_path = Str::slug($newImageName, '-').'_'.time().'.'.$extension;
            $newImageName = Str::slug($newImageName, '-').'_'.$date.'.'.$extension;

            $file->move(public_path(). DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'unit_avt'.DIRECTORY_SEPARATOR, $file_path);
        }

        $unit = unit::find($id);
        $unit->name = $request->name;
        $unit->email = $request->email;
        $unit->address = $request->address;
        $unit->phone = $request->phone;
        $unit->representative = $request->representative;
        $unit->position = $request->position;
        $unit->image = $request->getSchemeAndHttpHost().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'unit_avt'.DIRECTORY_SEPARATOR.$file_path;
        $unit->note = $request->note;
        $unit -> save();
        return redirect()->route('unit.index');
        }
        else
            return redirect()->back();
    }

}
