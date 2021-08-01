<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ContentDetail;
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
        // dd($request->user()->id);
        $request->validate([
            'folderName' => 'required',
        ]);

        $folder = new Content();
        $folder->title = $request->folderName;
        $folder->user_id = $request->user()->id;
        $folder->department_id = $request->user()->department_id;
        $folder->save();
        return back()->with('success', 'Folder has successfully created!');
    }
    public function update(Request $request, $id)
    {

        $folder = Content::find($id);
        $folder->title =  $request->input('name');
        $folder->save();
        return back();
    }

    public function destroy(Request $request, $id)
    {
        if($request->user()->can('delete_content')){
            $content = Content::find($id);
            $content->delete();
            $content_detail = ContentDetail::where('content_id', $id)->delete();
            return back();
        }
        else{
            abort(403);
        }
    }
}
