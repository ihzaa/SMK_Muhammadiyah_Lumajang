<?php

namespace App\Http\Controllers\Front_User;

use App\Http\Controllers\Controller;
use App\Models\Master\AboutUs;
use App\Models\Master\Announcement;
use App\Models\Master\News;
use App\Models\Master\Slider;
use Illuminate\Http\Request;

class LadingPageController extends Controller
{
    public function index()
    {
        $data['sliders'] = Slider::get();
        $data['about_us'] = AboutUs::find(1);
        $data['announcements'] = Announcement::limit(10)->orderBy('id', 'DESC')->get();
        $data['news'] = News::limit(10)->orderBy('id', 'DESC')->get();

        return view('front-user.pages.landing_page', compact('data'));
    }
}
