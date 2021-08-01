<?php

namespace App\Http\Controllers;

use App\Models\ContentDetail;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentDetailController extends Controller
{
    
    public function index (){
        $contentsDetail = ContentDetail::all();
        return view('content.detail', compact('contentsDetail'));
    }

    public function show (Request $request, $id){
        $contents = ContentDetail::where('content_id', $id)->get();
        $content_id = $id;
        // dd($contents);
        // gọi hàm view ở policy để check
        if($request->user()->can('view_content', $contents)) {
            return view('content.detail', compact('contents', 'content_id'));
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

    public function store(Request $req)
    {
        $req->validate([
            'imageFile' => 'required',
            'imageFile.*' => 'mimes:jpeg,jpg,png,csv,txt,pdf,xlsx,pptx,docx,jfif'
        ]);
      
        if($req->hasfile('imageFile')) {
            foreach($req->file('imageFile') as $file) {
                $name = $file->getClientOriginalName();
                $newImageName = Str::of($file->getClientOriginalName())->explode('.');
                $endpoint = $newImageName[count($newImageName) - 1];
                $newImageName = $newImageName[0];
                $newImageName = time().'-'.Str::slug($newImageName, '-').'.'.$endpoint;
                $size = $file->getSize();
                if ($size >= 1073741824) {
                    $size = number_format($size / 1073741824, 2) . ' GB';
                }
                elseif ($size >= 1048576) {
                    $size = number_format($size / 1048576, 2) . ' MB';
                }
                elseif ($size >= 1024) {
                    $size = number_format($size / 1024, 2) . ' KB';
                }
                elseif ($size > 1) {
                    $size = $size . ' bytes';
                }
                elseif ($size == 1) {
                    $size = $size . ' byte';
                }
                else {
                    $size = '0 bytes';
                }

                $department = Department::find($req->user()->department_id);

                $file->move($path = public_path(). DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR, $newImageName);
                $fileModal = new ContentDetail();
                $fileModal->name = $name;
                $fileModal->type = $endpoint;
                $fileModal->size = $size;
                $fileModal->content_id = $req->content_id;
                $fileModal->department_code = $department->department_code;
                $fileModal->link = $req->getSchemeAndHttpHost().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.$newImageName;
                $fileModal->save();
            }
            return back()->with('success', 'File has successfully uploaded!');
        }

    }
    public function update(Request $request, $id)
    {
        $file = ContentDetail::find($id);
        $file->name =  $request->input('name').'.'.$file->type;
        $file->save();
        return back();
    }

    public function destroy(Request $request, $id)
    {
        if($request->user()->can('delete_content')){
            $content = ContentDetail::find($id);
            $content->delete();
            return back();
        }
        else{
            abort(403);
        }
    }
}
