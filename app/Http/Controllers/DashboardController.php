<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContentType;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index() {
        $types = ContentType::all();
        Session::put('types', $types);
        if (Gate::allows('is-admin')) {
            $numImages = 0;
            $numMusics = 0;
            $numVideos = 0;
            foreach ($types as $type) {
                $amount = 0;
                foreach ($type->content as $content) {
                    $amount += $content->detail_content->count();
                }
                if($type->name === "image") {
                    $numImages = $amount;
                }
                if($type->name === "music") {
                    $numMusics = $amount;
                }
                if($type->name === "video") {
                    $numVideos = $amount;
                }
            }
            return view('dashboard.dashboard', compact("numImages", "numMusics", "numVideos"));
        }
        else{
            return redirect()->route('content.index');
        }
    }
}
