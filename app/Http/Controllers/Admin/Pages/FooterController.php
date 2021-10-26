<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\Master\FooterVideo;
use App\Utils\FlashMessageHelper;
use App\Utils\ValidationHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FooterController extends Controller
{
    public function index()
    {
        $data = FooterVideo::find(1);
        return view('admin.pages.pages.footer.index', compact('data'));
    }

    public function update(Request $request)
    {
        $validate = ValidationHelper::validate($request, [
            'url' => 'required',
        ], [], [
            'url' => 'URL Video Youtube',
        ]);

        if ($validate->fails()) {
            return ValidationHelper::validationError($validate);
        }

        DB::beginTransaction();
        $dom = new \domdocument();
        libxml_use_internal_errors(true);
        $dom->loadHtml($request->url, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $iframe = $dom->getelementsbytagname('iframe');
        foreach ($iframe as $i) {
            $i->removeattribute('height');
            $i->removeattribute('width');
            $i->setAttribute('height', '200');
            $i->setAttribute('width', '300');
            $i->setAttribute('style', "margin-top: 36px;margin-bottom: 36px;");
        }
        FooterVideo::find(1)->update([
            'url' => $dom->savehtml()
        ]);
        DB::commit();

        FlashMessageHelper::bootstrapSuccessAlert('Data berhasil diubah!');
        return redirect(route('admin.pages.footer.index'));
    }
}
