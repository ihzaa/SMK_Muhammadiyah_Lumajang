<?php

namespace App\Http\Controllers\Front_User;

use App\Http\Controllers\Controller;
use App\Models\Master\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $data['news'] = News::where('title', 'like', '%' . $request->search . '%')->orderBy('id', 'desc')->paginate(5);
        $data['news']->appends(['search' => $request->search]);
        $data['recentNews'] = News::orderBy('id', 'desc')->limit(4)->get();
        return view('front-user.pages.news.index', compact('data'));
    }

    public function show($title, $id)
    {
        $data['news'] = News::findOrFail($id);
        $data['recentNews'] = News::orderBy('id', 'desc')->limit(4)->get();
        return view('front-user.pages.news.show', compact('data'));
    }
}
