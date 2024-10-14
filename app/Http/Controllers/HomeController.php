<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }
    public function blogDetails($slug)
    {
        return view('home.blog',compact('slug'));
    }
}
