<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function gallery(){
        return view('website.gallery.index');
    }
    public function index(){
        return view('admin.gallery.index');
    }
}
