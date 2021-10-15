<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\DetailImage\NewsImage;
use App\Models\Master\News;
use App\Utils\FlashMessageHelper;
use App\Utils\ImageUploadHelper;
use App\Utils\ValidationHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = News::orderBy('updated_at', 'DESC');
            if ($request->status == 'delete') {
                $query = $query->onlyTrashed();
            } else if ($request->status == '') {
                $query = $query->withTrashed();
            }
            return datatables()->of($query)
                ->addColumn('status', function ($obj) {
                    if ($obj->trashed()) {
                        return '<span class="text-danger">Dihapus</span>';
                    } else {
                        return 'Aktif';
                    }
                })
                ->addColumn('action', function ($obj) {
                    $btnEdit = !$obj->trashed() ? '<a class="btn btn-sm mr-1 btn-success" href="' . route('admin.master.news.edit', ['id' => $obj->id]) . '" data-toggle="tooltip" data-placement="top" title="Lihat/Edit Data"><i class="fa fa-pencil-alt"></i></a>' : '';
                    $bntHapus = !$obj->trashed() ? '<a class="btn btn-sm mr-1 btn-danger" href="' . route('admin.master.news.delete', [$obj->id]) . '" onclick="return confirm(\'Yakin hapus data?\')" data-toggle="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a>' : '';
                    $btnRestore =  !$obj->trashed() ? '' : '<a class="btn btn-sm btn-secondary" href="' . route('admin.master.news.restore', [$obj->id]) . '" onclick="return confirm(\'Yakin mengembalikan data?\')" data-toggle="tooltip" data-placement="top" title="Kembalikan Data"><i class="fa fa-trash-restore"></i></a>';
                    $allBtn = $btnEdit . $bntHapus . $btnRestore;
                    return $allBtn;
                })
                ->editColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->format('d-m-Y');
                })
                ->editColumn('img_path', function ($data) {
                    return '<a href="' . asset($data->img_path) . '" data-lightbox="image-' . $data->id . '" data-title="' . $data->name . '"><img class="img-fluid" src="' . $data->thumbnail() . '"/></a>';
                })
                ->rawColumns(['img_path', 'action', 'status'])
                ->make(true);
        }
        return view('admin.pages.master.news.index');
    }

    public function create()
    {
        return view('admin.pages.master.news.create');
    }

    public function store(Request $request)
    {
        $validate = ValidationHelper::validate($request, [
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'body' => 'required'
        ], [
            'max' => 'Ukuran :attribute tidak boleh lebih dari :max KB'
        ], [
            'image' => 'Foto',
            'title' => 'Judul',
            'body' => 'Isi/Body'
        ]);

        if ($validate->fails()) {
            return ValidationHelper::validationError($validate);
        }

        DB::beginTransaction();

        $news = News::create([
            'title' => $request->title
        ]);

        $imageUploadResult = ImageUploadHelper::upload($request->file('image'), 'assets/images/news/cover/', $news->id . '-news');
        $news->img_path = '/' . $imageUploadResult['image_relative_path'];

        $body = $request->body;
        $dom = new \domdocument();
        $dom->loadHtml($body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');

        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name = $news->id . '-' . $k . '-' . time() . '.png';
            $path = 'assets/images/news/detail/' . $image_name;
            NewsImage::create([
                'img_path' => $path,
                'news_id' => $news->id
            ]);
            File::put('assets/images/news/detail/' . $image_name, $data);
            $img->removeattribute('src');
            $img->setattribute('src', asset($path));
        }
        $body = $dom->savehtml();
        $news->body = $body;
        $news->save();

        DB::commit();

        FlashMessageHelper::bootstrapSuccessAlert('Data berhasil ditambahkan!');

        return redirect(route('admin.master.news.index'));
    }

    public function edit($id)
    {
        $data = News::withTrashed()->findOrFail($id);

        return view('admin.pages.master.news.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $validate = ValidationHelper::validate($request, [
            'title' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'body' => 'required'
        ], [
            'max' => 'Ukuran :attribute tidak boleh lebih dari :max KB'
        ], [
            'image' => 'Foto',
            'title' => 'Judul',
            'body' => 'Isi/Body'
        ]);

        if ($validate->fails()) {
            return ValidationHelper::validationError($validate);
        }

        DB::beginTransaction();
        $news = News::findOrFail($id);
        $news->title = $request->title;
        if ($request->has('image')) {
            $imageUploadResult = ImageUploadHelper::upload($request->file('image'), 'assets/images/news/cover/', $news->id . '-news');
            $news->img_path = '/' . $imageUploadResult['image_relative_path'];
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
                $image_name = $news->id . '-' . $k . '-' . time() . '.png';
                $path = 'assets/images/news/detail/' . $image_name;
                NewsImage::create([
                    'img_path' => $path,
                    'news_id' => $news->id
                ]);
                File::put('assets/images/news/detail/' . $image_name, $data);
                $img->removeattribute('src');
                $img->setattribute('src', asset($path));
            }
        }
        $body = $dom->savehtml();
        $news->body = $body;
        $news->save();
        DB::commit();

        FlashMessageHelper::bootstrapSuccessAlert('Data berhasil diubah!');
        return redirect(route('admin.master.news.index'));
    }

    public function delete($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        FlashMessageHelper::bootstrapSuccessAlert('Data berhasil dihapus!');
        return redirect(route('admin.master.news.index'));
    }

    public function restore($id)
    {
        $news = News::onlyTrashed()->findOrFail($id);
        $news->restore();

        FlashMessageHelper::bootstrapSuccessAlert('Data berhasil dikembalikan!');
        return redirect(route('admin.master.news.index'));
    }
}
