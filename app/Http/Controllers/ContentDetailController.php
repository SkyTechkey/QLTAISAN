<?php

namespace App\Http\Controllers;

use App\Models\ContentDetail;
use Illuminate\Http\Request;

class ContentDetailController extends Controller
{
    
    public function index (){
        $contents = ContentDetail::all();
        return view('list',compact('contents'));
    }
    public function show (Request $request,$id){
        $content = ContentDetail::find($id);
        // gọi hàm view ở policy để check
        if($request->user()->can('view_content',$content)){
            return view('show', compact('content'));
        }
        else{
            abort(403);
        }
        
    }
    public function create(Request $request){
        if($request->user()->can('create_content')){
            return view('create');
        }
        else{
            abort(403);
        }
        
    }
    public function edit(Request $request,$id)
    {
        if($request->user()->can('update_content')){
            $content = ContentDetail::find($id);
            return view('create', compact('content'));
        }
        else{
            abort(403);
        }
    }

    public function store(Request $request)
    {
        $content = new ContentDetail();
    }
    public function update(Request $request, $id)
    {
        $content =  ContentDetail::find($id);
    }

    public function destroy(Request $request, $id)
    {
        if($request->user()->can('delete_content')){
            $content = ContentDetail::find($id);
            $content->delete();
            return view('list');
        }
        else{
            abort(403);
        }
    }
}
