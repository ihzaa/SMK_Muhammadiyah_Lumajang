<?php

namespace App\Http\Controllers\Front_User;

use App\Http\Controllers\Controller;
use App\Models\Master\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function show($title, $id)
    {
        $data['facility'] = Facility::findOrFail($id);
        $data['otherFacility'] = Facility::orderBy('id', 'desc')->where('id', '!=', $id)->get();

        return view('front-user.pages.facility', compact('data'));
    }
}
