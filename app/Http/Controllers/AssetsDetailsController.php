<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assets_details;
use App\Models\Provide;


class AssetsDetailsController extends Controller
{
    public function create()
    {
        return view('asset_details.create');
    }

    public function store(Request $req)
    {
        // dd($req);
        $req->validate([
            'assets' => 'required',
            'name' => 'required|max:255',
            'value' => 'required',
            'tech_info' => 'required',
        ]);

        $assets_details = new Assets_details();
        $assets_details->asset_id = $req->assets;
        $assets_details->accessory_name = $req->name;
        $assets_details->value = $req->value;
        $assets_details->tech_info = $req->tech_info;
        $save = $assets_details->save();

        if($save){
            return back()->with('success', 'New Asset details has been successfuly added to database');
        }else{
            return back()->with('fail','Something went wrong, try again!');
        }
    }
}
