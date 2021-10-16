<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Master\Announcement;
use App\Models\Master\Facility;
use App\Models\Master\News;
use App\Models\Master\Slider;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [];
        $data['user'] = User::count();
        $data['slider'] = Slider::count();
        $data['news'] = News::count();
        $data['announcement'] = Announcement::count();
        $data['facility'] = Facility::count();
        return view('admin.pages.dashboard', compact('data'));
    }
}
