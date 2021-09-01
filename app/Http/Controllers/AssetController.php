<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Assets_details;
use App\Models\Repair_cost;
use App\Models\Department;
use App\Models\Branch;
use App\Models\Property_group;
use App\Models\Property_type;
use App\Models\Provide;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AssetController extends Controller
{
    public function index(Request $request)
    {
        $branches = '';
        if($request->user()->can('is-admin')){
            $branches = Branch::all();
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
            return view('assets.index',compact('assets','provides','property_types','property_groups','departments', 'branches'));
    }
    public function create(Request $request)
    {  
       
        $detail_id = $request -> detail_id;
        $detail_type = $request -> detail_type;
        $assets = Asset::all();
        $provides = Provide::all();
        $property_types = Property_type::all();
        $property_groups = Property_group::all();
        $departments = Department::all();
        return view('assets.create',compact('detail_id','detail_type','assets','provides','property_types','property_groups','departments'));
    }

    protected function caculateDepreciation($first_value, $percent){
        $dep_value = $percent / 100 * $first_value;
        $residual_value =  $first_value - $dep_value;
        return [$dep_value,$residual_value];
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'max:10|unique:assets',
            'usage_status' => 'required',
            'depreciation_per_year' => 'required|max:100'
        ]);
        $assets = new Asset();
        $assets->name = $request->name;
        if( $request->code == ''){
            $count = Asset::where('property_group_id',$request -> property_group_id)->count();
            $property_group = Property_group::find($request -> property_group_id);
            $assets->code = $property_group -> code.$count;
        }
        else{
            $assets->code = $request -> code;
        }
        $assets->usage_status = $request -> usage_status;
        $assets->date_purchase = $request -> date_purchase;
        $assets->warranty_expires = $request -> warranty_expires;
        $assets->date_liquidation = $request -> date_liquidation;
        $assets->first_value = $request -> first_value;
        $assets->depreciation_per_year = $request -> depreciation_per_year;
        $assets->department_id = $request->department_id;
        $assets->provide_id = $request -> provide_id;
        $assets->property_type_id = $request ->property_type_id;
        $assets->property_group_id = $request -> property_group_id;
        $assets->access_status = $request -> access_status;

        $arr = $this->caculateDepreciation($request -> first_value,$request -> depreciation_per_year);
        $assets->depreciation = $arr[0]; //giá trị khấu khao
        $assets->residual_value = $arr[1]; // giá trị còn lại

        $assets->note = $request -> note;
        $save = $assets->save();
        if($save){
            $assets = Asset::orderBy('id', 'desc')->first();
            if($request->hasfile('files')) {
                $files = $request->file('files');
                $date = now();
                $date = $date->format('d-m-Y-H-i-s');
                foreach($files as $file) {
                    $index = array_search($file, $files) + 1;
                    $extension = $file->extension();
                    $newImageName = Str::slug($assets->name, '-').'-'.$index.'_'.$date.'.'.$extension;

                    $fileTerm = new FileUpload();
                    $fileTerm->asset_id = $assets->id;
                    $fileTerm->name = $newImageName;
                    $file->move(public_path().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR, $newImageName);
                    $fileTerm->path = $request->getSchemeAndHttpHost().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.$newImageName;
                    $fileTerm->save();
                }
            }

            if($request -> detail_type == "receipt"){
                return redirect()->route('detail-receipt-note.show',$request->detail_id)->with('success', 'Hành động thực hiện thành công');
            }
            else if($request -> detail_type == "delivery"){
                return redirect()->route('detail-delivery-note.show',$request->detail_id)->with('success', 'Hành động thực hiện thành công');
            }
            else{
                Session::put('id_assets', $assets->id);
                return redirect()->route('assets-detail.create')
                ->with('success', 'New Asset has been successfuly added to database');
            }
           
        }else{
            return redirect()->route('assets.index')->with('fail','Something went wrong, try again!');
        }
    }

    public function show($id)
    {
        $asset_id = $id;
        $assets_details = Assets_details::where('asset_id', $id)->get();
        $repair_costs = Repair_cost::where('asset_id', $id)->get();
        $files = FileUpload::where('asset_id', $id)->get();
        return view('asset_details.index', compact('assets_details', 'asset_id', 'repair_costs', 'files'));
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
        $assets->depreciation_per_year = $request -> depreciation_per_year;
        $assets->department_id = $request->department_id;

        $arr = $this->caculateDepreciation($request -> first_value,$request -> depreciation_per_year);
        $assets->depreciation = $arr[0]; //giá trị khấu khao
        $assets->residual_value = $arr[1]; // giá trị còn lại

        $assets->provide_id = $request -> provide_id;
        $assets->property_type_id = $request ->property_type_id;
        $assets->property_group_id = $request -> property_group_id;
        $assets->access_status = $request -> access_status;
        $assets->note = $request -> note;
        $save = $assets->save();
        if($save){
            return redirect()->route('assets.index')->with('success', 'Hành động thực hiện thành công');
        }else{
            return redirect()->route('assets.index')->with('fail','Something went wrong, try again!');
        }
    }
    public function destroy($id){
        $asset = Asset::find($id);
        $asset -> delete();
        return redirect()->route('assets.index');
    }

    public function getAssets($branch_id) {
        $assets = [];
        if($branch_id == 0) {
            $assets = Asset::all();
            foreach($assets as $asset) {
                $asset->property_type_name = Property_type::where('id', $asset->property_type_id)->firstOrFail()->name;
                $asset->property_group_name = Property_group::where('id', $asset->property_group_id)->firstOrFail()->name;
            }
        }
        else {
            $departs = Department::where('branch_id', $branch_id)->get();
            foreach($departs as $depart) {
                $assetsTerm = Asset::where('department_id', $depart->id)->get();
                foreach($assetsTerm as $assetTerm) {
                    $assetTerm->property_type_name = Property_type::where('id', $assetTerm->property_type_id)->firstOrFail()->name;
                    $assetTerm->property_group_name = Property_group::where('id', $assetTerm->property_group_id)->firstOrFail()->name;
                    $assets[count($assets)] = $assetTerm;
                }
            }
        }
        
        return $assets;
    }
}
