<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Assets_details;
use App\Models\Repair_cost;
use App\Models\Department;
use App\Models\Property_group;
use App\Models\Property_type;
use App\Models\Provide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AssetController extends Controller
{
    public function index(Request $request)
    {  
        if($request->user()->can('is-admin')){
            $assets = Asset::all();
        }
        else{
            $department_id = Auth::user()->department_id;
            $assets = Asset::where('department_id',$department_id)->get();
        }
            $provides = Provide::all();
            $property_types = Property_type::all();
            $property_groups = Property_group::all();
            $departments = Department::all();
            return view('assets.index',compact('assets','provides','property_types','property_groups','departments'));
    }
    public function store(Request $request)
    {
      
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:10|unique:assets',
            'usage_status' => 'required',
        ]);
        $assets = new Asset();
        $assets->name = $request->name;
        $assets->code = $request -> code;
        $assets->usage_status = $request -> usage_status;
        $assets->date_purchase = $request -> date_purchase;
        $assets->warranty_expires = $request -> warranty_expires;
        $assets->date_liquidation = $request -> date_liquidation;
        $assets->first_value = $request -> first_value;
        $assets->residual_value = $request -> residual_value;
        $assets->depreciation_per_year = $request -> depreciation_per_year;
        $assets->depreciation = $request -> depreciation;
        $assets->department_id = $request->department_id;
        $assets->provide_id = $request -> provide_id;
        $assets->property_type_id = $request ->property_type_id;
        $assets->property_group_id = $request -> property_group_id;
        $assets->access_status = $request -> access_status;
        $assets->note = $request -> note;
        $save = $assets->save();
        if($save){
            $id_assets = Asset::orderBy('id', 'desc')->first()->id;
            Session::put('id_assets', $id_assets);
            return redirect()->route('assets-details.create')
            ->with('success', 'New Asset has been successfuly added to database');
        }else{
            return redirect()->route('assets.index')->with('fail','Something went wrong, try again!');
        }
    }

    public function show($id)
    {
        $asset_id = $id;
        $assets_details = Assets_details::where('asset_id', $id)->get();
        $repair_costs = Repair_cost::where('asset_id', $id)->get();
        return view('asset_details.index', compact('assets_details', 'asset_id', 'repair_costs'));
    }

    public function update(Request $request,$id)
    {
      
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:10|unique:assets',
            'usage_status' => 'required',
        ]);

        $assets = Asset::find($id);
        $assets->name = $request->name;
        $assets->code = $request -> code;
        $assets->usage_status = $request -> usage_status;
        $assets->date_purchase = $request -> date_purchase;
        $assets->warranty_expires = $request -> warranty_expires;
        $assets->date_liquidation = $request -> date_liquidation;
        $assets->first_value = $request -> first_value;
        $assets->residual_value = $request -> residual_value;
        $assets->depreciation_per_year = $request -> depreciation_per_year;
        $assets->depreciation = $request -> depreciation;
        $assets->department_id = $request->department_id;
        $assets->provide_id = $request -> provide_id;
        $assets->property_type_id = $request ->property_type_id;
        $assets->property_group_id = $request -> property_group_id;
        $assets->access_status = $request -> access_status;
        $assets->note = $request -> note;
        $save = $assets->save();
        if($save){
            return redirect()->route('assets.index')->with('success','New Asset has been successfuly added to database');
        }else{
            return redirect()->route('assets.index')->with('fail','Something went wrong, try again!');
        }
    }
    public function destroy($id){
        $asset = Asset::find($id);
        $asset -> delete();
        return redirect()->route('assets.index');
    }
}
