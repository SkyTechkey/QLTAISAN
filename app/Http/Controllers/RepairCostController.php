<?php

namespace App\Http\Controllers;

use App\Models\Repair_cost;
use App\Models\Asset;
use Illuminate\Http\Request;

class RepairCostController extends Controller
{
   
    public function index()
    {
        $assets = Asset::all();
        $repair_costs = Repair_cost::all();
        return view('repair_cost.index', compact('repair_costs', 'assets'));
    }
    public function create()
    {
        //
    }
    public function store(Request $req)
    {
        $req->validate([
            'assets' => 'required',
            'date' => 'required',
            'cost' => 'required',
            'details' => 'required',
        ]);

        $repair_cost = new Repair_cost();
        $repair_cost->asset_id = $req->assets;
        $repair_cost->provide_id = Asset::where('id', $req->assets)->firstOrFail()->provide_id;
        $repair_cost->date = $req->date;
        $repair_cost->cost = $req->cost;
        $repair_cost->details = $req->details;
        $save = $repair_cost->save();

        if($save){
            return back()->with('success', 'Hành động thực hiện thành công');
        }else{
            return back()->with('fail','Something went wrong, try again!');
        }
    }
    public function show(Repair_cost $repair_cost)
    {
        //
    }
    public function edit(Repair_cost $repair_cost)
    {
        //
    }
    public function update(Request $req, $id)
    {
        $req->validate([
            'assets' => 'required',
            'date' => 'required',
            'cost' => 'required',
            'details' => 'required',
        ]);
        $repair_cost = Repair_cost::find($id);
        $repair_cost->asset_id = $req->assets;
        $repair_cost->provide_id = Asset::where('id', $req->assets)->firstOrFail()->provide_id;
        $repair_cost->date = $req->date;
        $repair_cost->cost = $req->cost;
        $repair_cost->details = $req->details;
        $save = $repair_cost->save();

        if($save){
            return back()->with('success', 'Hành động thực hiện thành công');
        }else{
            return back()->with('fail','Something went wrong, try again!');
        }
    }
    public function destroy($id)
    {
        $repair_cost = Repair_cost::find($id)->delete();
        if($repair_cost){
            return back()->with('success', 'Xóa thành công');
        }else{
            return back()->with('fail','Xóa không thành công');
        }
    }
}
