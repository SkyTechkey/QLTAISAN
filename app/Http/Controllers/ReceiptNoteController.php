<?php

namespace App\Http\Controllers;

use App\Models\Delivery_note;
use App\Models\Receipt_note;
use App\Models\User;
use Illuminate\Http\Request;

class ReceiptNoteController extends Controller
{
    public function index(Request $request)
    {
        // if($request->user()->can('is-admin')){
        //     $notes = Receipt_note::all();
        // }
        // else{
        //     $department_id = Auth::user()->department_id;
        //     $assets = Asset::where('department_id',$department_id)->get();
        // }
        $notes_receipt = Receipt_note::all();
        $notes_delivery = Delivery_note::all();
        $users = User::all();
        return view('notes.index',compact('notes_receipt','notes_delivery','users'));
    }
    public function store(Request $request)
    {
        $request->validate();
        $receipt_note = new Receipt_note();
        $receipt_note->code = $request->code;
        $receipt_note->deliver = $request->deliver;
        $receipt_note->position = $request->position;
        $receipt_note->location = $request->location;
        $receipt_note->user_id = $request->user_id;
        $receipt_note->date = $request->date;
        $receipt_note->note = $request->note;
        $save = $receipt_note->save();
        if($save){
            return redirect()->route('receipt-note.index')
            ->with('success', 'Hành động thực hiện thành công');
        }else{
            return redirect()->route('receipt-note.index')->with('fail','Something went wrong, try again!');
        }
    }
    public function update(Request $request, $id)
    {
        $receipt_note = Receipt_note::find($id);
        $receipt_note->code = $request->code;
        $receipt_note->deliver = $request->deliver;
        $receipt_note->position = $request->position;
        $receipt_note->location = $request->location;
        $receipt_note->user_id = $request->user_id;
        $receipt_note->date = $request->date;
        $receipt_note->note = $request->note;
        $save = $receipt_note->save();
        if($save){
            return redirect()->route('receipt-note.index')
            ->with('success', 'Hành động thực hiện thành công');
        }else{
            return redirect()->route('receipt-note.index')->with('fail','Something went wrong, try again!');
        }
    }
    public function destroy($id){
        $receipt_note = Receipt_note::find($id)->delete();
        if($receipt_note){
            return redirect()->route('receipt-note.index')
            ->with('success', 'Hành động thực hiện thành công');
        }else{
            return redirect()->route('receipt-note.index')->with('fail','Something went wrong, try again!');
        }
    }
}
