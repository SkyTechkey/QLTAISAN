<?php

namespace App\Http\Controllers;

use App\Models\Repair_cost;
use App\Models\Asset;
use Illuminate\Http\Request;

class RepairCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = Asset::all();
        $repair_costs = Repair_cost::all();
        return view('repair_cost.index', compact('repair_costs', 'assets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            return back()->with('success', 'New Repair cost has been successfuly added to database');
        }else{
            return back()->with('fail','Something went wrong, try again!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Repair_cost  $repair_cost
     * @return \Illuminate\Http\Response
     */
    public function show(Repair_cost $repair_cost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Repair_cost  $repair_cost
     * @return \Illuminate\Http\Response
     */
    public function edit(Repair_cost $repair_cost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Repair_cost  $repair_cost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Repair_cost $repair_cost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Repair_cost  $repair_cost
     * @return \Illuminate\Http\Response
     */
    public function destroy(Repair_cost $repair_cost)
    {
        //
    }
}
