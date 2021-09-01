<?php

namespace App\Http\Controllers;

use App\Models\FileUpload;
use Illuminate\Http\Request;

use App\Models\Asset;
use Illuminate\Support\Str;

class FileUploadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        if($request->hasfile('files')) {
            $assets_id = $request->assets_id;
            $assets = Asset::find($assets_id);
            $files = $request->file('files');
            $date = now();
            $date = $date->format('d-m-Y-H-i-s');
            $count = 0;
            foreach($files as $file) {
                $index = array_search($file, $files) + 1;
                $extension = $file->extension();
                $newImageName = Str::slug($assets->name, '-').'-'.$index.'_'.$date.'.'.$extension;

                $fileTerm = new FileUpload();
                $fileTerm->asset_id = $assets->id;
                $fileTerm->name = $newImageName;
                $file->move(public_path().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR, $newImageName);
                $fileTerm->path = $request->getSchemeAndHttpHost().DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'assets'.DIRECTORY_SEPARATOR.$newImageName;
                $save = $fileTerm->save();
                if($save) {
                    $count++;
                }
            }
            if($count == count($files)) {
                return back()->with('success', 'Hành động thực hiện thành công');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function show(FileUpload $fileUpload)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function edit(FileUpload $fileUpload)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FileUpload $fileUpload)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FileUpload  $fileUpload
     * @return \Illuminate\Http\Response
     */
    public function destroy(FileUpload $fileUpload, $id)
    {
        $file = FileUpload::find($id);
        $delete = $file->delete();
        if($delete){
            return back()->with('success', 'Deleted successful');
        }else{
            return back()->with('fail','Cannot delete!');
        }
    }
}
