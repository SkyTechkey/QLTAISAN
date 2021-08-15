<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ContentDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ContentController extends Controller
{
    public function index (Request $request){
        return view("index");
    }
    
    public function show(Request $request, $id) {
        $fdate = now()->subMonth(3);
        $ldate = now();
        $content_type_id = $id;
        $search = "";
        $contents = Content::where("content_type_id", $id)
                        ->whereBetween("created_at", [$fdate, $ldate])
                        ->get();
        // gọi hàm view ở policy để check
        if($request->user()->can("view_content", $contents)){
            return view("content.list", compact("contents", "content_type_id", "search", "fdate", "ldate"));
        }
        else{
            abort(403);
        }
    }
  
    public function create(Request $request) {
        if($request->user()->can("create_content")){
            return view("content.create");
        }
        else{
            abort(403);
        }
        
    }
    public function edit(Request $request,$id)
    {
        if($request->user()->can("update_content")) {
            $content = Content::find($id);
            return view("content.edit", compact("content"));
        }
        else{
            abort(403);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            "folderName" => "required",
        ]);

        $folder = new Content();
        $folder->title = $request->folderName;
        $folder->user_id = $request->user()->id;
        $folder->department_id = $request->user()->department_id;
        $folder->content_type_id = $request->content_type_id;
        $folder->save();
        return back()->with("success", "Folder has successfully created!");
    }
    public function update(Request $request, $id)
    {

        $folder = Content::find($id);
        $folder->title =  $request->input("name");
        $folder->save();
        return back();
    }

    public function destroy(Request $request, $id)
    {
        if($request->user()->can("delete_content")){
            $content = Content::find($id);
            $content->delete();
            $content_detail = ContentDetail::where("content_id", $id)->delete();
            return back();
        }
        else{
            abort(403);
        }
    }

    public function searchFolder(Request $req) {
        $search = $req->searchInfo;
        $content_type_id = $req->content_type_id;
        $fdate = $req->fdate.' 00:00:00';
        $ldate = $req->ldate.' 23:59:59';
        if($fdate && $ldate) {
            if($search) {
                $contents = Content::where("content_type_id", $content_type_id)
                                    ->where("title", "LIKE", "%".$search."%")
                                    ->whereBetween("created_at", [$fdate, $ldate])
                                    ->get();
            }
            else {
                $contents = Content::where("content_type_id", $content_type_id)
                                    ->whereBetween("created_at", [$fdate, $ldate])
                                    ->where("content_type_id", $content_type_id)
                                    ->get();
            }
        }
        else {
            if($search) {
                $contents = Content::where("content_type_id", $content_type_id)
                                    ->where("title", "LIKE", "%".$search."%")
                                    ->get();
            }
            else {
                $contents = Content::where("content_type_id", $content_type_id)->get();
            }
        }
        return view("content.list", compact("contents", "content_type_id", "search", "fdate", "ldate"));
    }
}
