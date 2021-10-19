<?php

namespace App\Http\Controllers\Front_User;

use App\Http\Controllers\Controller;
use App\Models\Master\AboutUs;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutUs = AboutUs::find(1);

        return view('front-user.pages.about_us', compact('aboutUs'));
    }
}
