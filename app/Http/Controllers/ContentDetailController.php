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
    protected $search;
    public function index (){
        $contentsDetail = ContentDetail::all();
        return view('content.detail', compact('contentsDetail'));
    }

    public function show (Request $request, $id){
        $contents = ContentDetail::where('content_id', $id)->get();
        $content_id = $id;
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
            'file' => 'required',
        ]);

        $file = $req->file;
        if($file) {
            $date = now();
            $date = $date->format('d-m-Y-H-i-s');
            $destinationPath = public_path().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'thumbnail';
            if (!file_exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0775, true);
            }                
            $filename = $file->getClientOriginalName();
            $explode = Str::of($filename)->explode('::');
            $note = $explode[1];
            $privacy = $explode[2];
            $content_id = $explode[3];

            $newImageName = Str::of($filename)->explode('.')[0];
            
            $extension = $file->extension();

            $file_path = Str::slug($newImageName, '-').'_'.time().'.'.$extension; //ok
            $newImageName = Str::slug($newImageName, '-').'_'.$date.'.'.$extension; //ok
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
            if(in_array($extension, ["jpg", "png"])) {
                $imgFile = Image::make($file->getRealPath());
                $imgFile->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath.'/'.$file_path);
                $link_thumbnail = $req->getSchemeAndHttpHost().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'thumbnail'.DIRECTORY_SEPARATOR.$file_path;
            }

            if($privacy === "true") {
                $privacy = "Public";
            }
            else {
                $privacy = NULL;
            }

            $department = Department::find($req->user()->department_id);
            $file->move($path = public_path(). DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR, $file_path);
            $fileModal = new ContentDetail();
            $fileModal->name = $newImageName;
            $fileModal->type = $extension;
            $fileModal->size = $size;
            $fileModal->note = $note;
            $fileModal->privacy = $privacy;
            $fileModal->content_id = $content_id;
            $fileModal->department_code = $department->department_code;
            $fileModal->link_thumbnail = $link_thumbnail;
            $fileModal->link = $req->getSchemeAndHttpHost().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.$file_path;
            $fileModal->save();
            sleep(1);
            return response()->json(['success' => true]);
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

    public function download(Request $request, $id) {
        $file = ContentDetail::find($id);
        $path = Str::of($file->link)->explode(DIRECTORY_SEPARATOR);
        $path = $path[count($path) - 2].DIRECTORY_SEPARATOR.$path[count($path) - 1];
        return response()->download($path);
    }

    public function destroy(Request $request, $id)
    {
        if($request->user()->can('delete_content')){
            $content = ContentDetail::find($id);
            
            $link = $content->link;
            $link = Str::of($link)->explode(DIRECTORY_SEPARATOR);
            $link = public_path().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.$link[count($link) - 1];
            if(file_exists($link)) {
                unlink($link);
            }

            $link_thumbnail = $content->link_thumbnail;
            if($link_thumbnail) {
                $link_thumbnail = Str::of($link_thumbnail)->explode(DIRECTORY_SEPARATOR);
                $link_thumbnail = public_path().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'thumbnail'.DIRECTORY_SEPARATOR.$link_thumbnail[count($link_thumbnail) - 1];
                if(file_exists($link_thumbnail)) {
                    unlink($link_thumbnail);
                }
            }

            $content->delete();

            return back();
        }
        else{
            abort(403);
        }
    }

    public function searchFile(Request $req) {
        $this->search = $req->searchInfo;
        $content_id = $req->content_id;

        if($req->fdate && $req->ldate) {
            $fdate = $req->fdate.' 00:00:00';
            $ldate = $req->ldate.' 23:59:59';
            if($this->search) {
                $contents = ContentDetail::where('content_id', $content_id)
                                        ->where(function($query) {
                                            $query->where('name', 'LIKE', "%".$this->search."%")
                                                ->orWhere('note', 'LIKE', "%".$this->search."%");
                                        })->whereBetween('created_at', [$fdate, $ldate])
                                        ->get();
            }
            else {
                $contents = ContentDetail::where('content_id', $content_id)
                                        ->whereBetween('created_at', [$fdate, $ldate])
                                        ->get();
            }
        }
        else {
            if($this->search) {
                $contents = ContentDetail::where('content_id', $content_id)
                                        ->where(function($query) {
                                            $query->where('name', 'LIKE', "%".$this->search."%")
                                                ->orWhere('note', 'LIKE', "%".$this->search."%");
                                        })->get();
            }
            else {
                $contents = ContentDetail::where('content_id', $content_id)->get();
            }
        }
        return view('content.detail', compact('contents', 'content_id'));
    }

    public function searchFiles(Request $req) {
        $content_id = $req->content_id;
        $search = $req->searchInfo;
        $contents = ContentDetail::where('name', 'LIKE', "%".$search."%")
                                ->orWhere('note', 'LIKE', "%".$search."%")
                                ->get();
        return view('content.detail', compact('contents', 'content_id'));
    }
}