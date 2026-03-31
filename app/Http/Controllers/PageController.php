<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function landing() {
        return view('landing'); // untuk landing.blade.php
    }

    public function about() {
        return view('about'); // untuk about.blade.php
    }

    public function contact() {
        return view('contact'); // untuk contact.blade.php
    }
}