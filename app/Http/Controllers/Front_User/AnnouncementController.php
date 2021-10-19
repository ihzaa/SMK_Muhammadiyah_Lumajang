<?php

namespace App\Http\Controllers\Front_User;

use App\Http\Controllers\Controller;
use App\Models\Master\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index(Request $request)
    {
        $data['announcements'] = Announcement::where('title', 'like', '%' . $request->search . '%')->orderBy('id', 'desc')->paginate(5);
        $data['announcements']->appends(['search' => $request->search]);
        $data['recentAnnouncements'] = Announcement::orderBy('id', 'desc')->limit(4)->get();

        return view('front-user.pages.announcement.index', compact('data'));
    }

    public function show($title, $id)
    {
        $data['announcements'] = Announcement::findOrFail($id);
        $data['recentAnnouncements'] = Announcement::orderBy('id', 'desc')->limit(4)->get();

        return view('front-user.pages.announcement.show', compact('data'));
    }
}
