<?php

namespace App\Http\Controllers;

use App\Models\ContentDetail;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Image;

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
            'imageFile.*' => 'mimes:jpg,png,csv,txt,pdf,xlsx,pptx,docx',
            'name'=> 'required'
        ]);
        
        if($req->hasfile('imageFile')) {
            $date = now();
            $date = $date->format('d-m-Y-H-i-s');
            $destinationPath = public_path().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'thumbnail';
            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true);
            }
            foreach($req->file('imageFile') as $file) {
                $name = $file->getClientOriginalName();
                $newImageName = Str::of($file->getClientOriginalName())->explode('.');
                $endpoint = $file->getClientOriginalExtension();
                $newImageName = $newImageName[0];
                $newImageName = Str::slug($req->name, '-').'_'.$date.'.'.$endpoint;
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
                
                $link_thumbnail = NULL;
                if(in_array($endpoint, ["jpg", "png"])) {
                    $imgFile = Image::make($file->getRealPath());
                    $imgFile->resize(150, 100, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPath.'/'.$newImageName);
                    $link_thumbnail = $req->getSchemeAndHttpHost().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'thumbnail'.DIRECTORY_SEPARATOR.$newImageName;
                }

                $department = Department::find($req->user()->department_id);
                $file->move($path = public_path(). DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR, $newImageName);
                $fileModal = new ContentDetail();
                $fileModal->name = $newImageName;
                $fileModal->type = $endpoint;
                $fileModal->size = $size;
                $fileModal->content_id = $req->content_id;
                $fileModal->department_code = $department->department_code;
                $fileModal->link_thumbnail = $link_thumbnail;
                $fileModal->link = $req->getSchemeAndHttpHost().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.$newImageName;
                $fileModal->save();
            }
            return back()->with('success', 'File has successfully uploaded!');
        }

    }
    public function update(Request $request, $id)
    {
        $file = ContentDetail::find($id);
        $date = now();
        $date = $date->format('d-m-Y-H-i-s');
        $file->name = Str::slug($request->name, '-').'_'.$date.'.'.$file->type;
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
