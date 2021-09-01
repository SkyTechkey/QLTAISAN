<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\Detail_delivery_note;
use App\Models\User;
use Illuminate\Http\Request;

class DetailDeliveryNoteController extends Controller
{
    public function index(Request $request)
    {
        $users = User::all();
        $details = Detail_delivery_note::all();
        return view('detail-delivery-notes.index',compact('details','users'));
    }
    public function show(Request $request, $id)
    {
        $note_id = $id;
        $assets = Asset::all();
        $users = User::all();
        $details = Detail_delivery_note::where('PX_id',$id)->get();
      
        return view('detail-delivery-notes.index',compact('details','users','note_id','assets'));
    }
    public function store(Request $request)
    {
        $detail = new Detail_delivery_note();
        $detail -> PX_id = $request -> PX_id;
        $detail -> asset_id = $request -> asset_id;
        $detail -> amount = $request -> amount;
        $detail -> unit_price = $request -> unit_price;
        $detail -> total = $request -> amount * $request -> unit_price;
        $detail -> note = $request -> note;
        $detail -> save();
        return redirect()->back()->with('success', 'Hành động thực hiện thành công');
    }
    public function update(Request $request, $id)
    {
        $detail =  Detail_delivery_note::find($id);
        $detail -> PX_id = $request -> PX_id;
        $detail -> asset_id = $request -> asset_id;
        $detail -> amount = $request -> amount;
        $detail -> unit_price = $request -> unit_price;
        $detail -> total = $request -> amount * $request -> unit_price;
        $detail -> note = $request -> note;
        $detail -> save();
        return redirect()->back()->with('success', 'Hành động thực hiện thành công');
    }
    public function destroy($id)
    {
        $detail =  Detail_delivery_note::find($id)->delete();
      
        return redirect()->back();
    }
}
