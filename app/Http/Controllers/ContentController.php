<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    public function index (Request $request){
        if($request->user()->can('is-admin')){
            $contents = Content::all();
        }
        else{
            $department_id = Auth::user()->department_id;
            $contents = Content::where('department_id',$department_id)->get();
        }
        foreach($contents as $content){
           $content->user;
        }
        return view('content.list',compact('contents'));
    }
    public function show (Request $request,$id){
        $content = Content::find($id);
        // gọi hàm view ở policy để check
        if($request->user()->can('view_content',$content)){
            return view('content.show', compact('content'));
        }
        else{
            abort(403);
        }
        
    }
    public function create(Request $request){
        if($request->user()->can('create_content')){
            return view('content.create');
        }
        else{
            abort(403);
        }
        
    }
    public function edit(Request $request,$id)
    {
        if($request->user()->can('update_content')){
            $content = Content::find($id);
            return view('content.edit', compact('content'));
        }
        else{
            abort(403);
        }
    }

    public function store(Request $request)
    {
        //
    }
    public function update(Request $request, $id)
    {
        $content = Content::find($id);
        $content->title = $request->title;
        $content->content = $request->content;
        $content->note = $request->note;
        $content->updated_at = now();
        $content -> save();
        return redirect()->route('content.index');
    }

    public function destroy(Request $request, $id)
    {
        if($request->user()->can('delete_content')){
            $content = Content::find($id);
            $content->delete();
            return view('content.list');
        }
        else{
            abort(403);
        }
    }
}
