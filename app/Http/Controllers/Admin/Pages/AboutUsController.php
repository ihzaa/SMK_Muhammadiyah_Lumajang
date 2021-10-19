<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\Master\AboutUs;
use App\Models\Master\DetailImage\AboutUsImage;
use App\Utils\FlashMessageHelper;
use App\Utils\ImageUploadHelper;
use App\Utils\ValidationHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AboutUsController extends Controller
{
    public function index()
    {
        $data = AboutUs::find(1);
        return view('admin.pages.pages.about_us.index', compact('data'));
    }

    public function update(Request $request)
    {
        $validate = ValidationHelper::validate($request, [
            'body' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [], [
            'body' => 'Isi/Body',
            'image' => 'Foto'
        ]);

        if ($validate->fails()) {
            return ValidationHelper::validationError($validate);
        }

        DB::beginTransaction();
        $AboutUs = AboutUs::findOrFail(1);

        if ($request->has('image')) {
            $imageUploadResult = ImageUploadHelper::upload($request->file('image'), 'assets/images/about_us/', $AboutUs->id . '-cover_about_us', false);
            $AboutUs->img_path = '/' . $imageUploadResult['image_relative_path'];
        }

        $body = $request->body;
        $dom = new \domdocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');

        //UPLOAD GAMBAR BARU DI KONTEN KALAU ADA
        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');
            if ($data[0] != 'h') {
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                $data = base64_decode($data);
                $image_name = $AboutUs->id . '-' . $k . '-' . time() . '.png';
                $path = 'assets/images/about_us/' . $image_name;
                AboutUsImage::create([
                    'img_path' => $path,
                    'about_us_id' => 1
                ]);
                File::put('assets/images/about_us/' . $image_name, $data);
                $img->removeattribute('src');
                $img->setattribute('src', asset($path));
            }
        }
        $body = $dom->savehtml();
        $AboutUs->body = $body;
        $AboutUs->save();
        DB::commit();

        FlashMessageHelper::bootstrapSuccessAlert('Data berhasil diubah!');
        return redirect(route('admin.pages.about-us.index'));
    }
}
