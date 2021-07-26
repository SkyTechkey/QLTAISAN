<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function content()
    {
        return view('pages.dashboard.dashboard')->with('dashboard');
    }
    public function content1()
    {
        return view('pages.dashboard.dashboard2')->with('dashboard2');
    }
    public function content2()
    {
        return view('pages.dashboard.dashboard3')->with('dashboard3');
    }
    public function calendar()
    {
        return view('pages.calendar.calendar')->with('calendar');
    }
    public function gallery()
    {
        return view('pages.gallery.gallery')->with('gallery');
    }
}
