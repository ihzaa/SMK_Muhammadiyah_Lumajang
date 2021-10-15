<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\DetailImage\FacilityImage;
use App\Models\Master\Facility;
use App\Utils\FlashMessageHelper;
use App\Utils\ImageUploadHelper;
use App\Utils\ValidationHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FacilityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Facility::orderBy('updated_at', 'DESC');
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
                    $btnEdit = !$obj->trashed() ? '<a class="btn btn-sm mr-1 btn-success" href="' . route('admin.master.facility.edit', ['id' => $obj->id]) . '" data-toggle="tooltip" data-placement="top" title="Lihat/Edit Data"><i class="fa fa-pencil-alt"></i></a>' : '';
                    $bntHapus = !$obj->trashed() ? '<a class="btn btn-sm mr-1 btn-danger" href="' . route('admin.master.facility.delete', [$obj->id]) . '" onclick="return confirm(\'Yakin hapus data?\')" data-toggle="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a>' : '';
                    $btnRestore =  !$obj->trashed() ? '' : '<a class="btn btn-sm btn-secondary" href="' . route('admin.master.facility.restore', [$obj->id]) . '" onclick="return confirm(\'Yakin mengembalikan data?\')" data-toggle="tooltip" data-placement="top" title="Kembalikan Data"><i class="fa fa-trash-restore"></i></a>';
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
        return view('admin.pages.master.facility.index');
    }

    public function create()
    {
        return view('admin.pages.master.facility.create');
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

        $facility = Facility::create([
            'title' => $request->title
        ]);

        $imageUploadResult = ImageUploadHelper::upload($request->file('image'), 'assets/images/facilities/cover/', $facility->id . '-facility');
        $facility->img_path = '/' . $imageUploadResult['image_relative_path'];

        $body = $request->body;
        $dom = new \domdocument();
        $dom->loadHtml($body, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');

        foreach ($images as $k => $img) {
            $data = $img->getattribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name = $facility->id . '-' . $k . '-' . time() . '.png';
            $path = 'assets/images/facilities/detail/' . $image_name;
            FacilityImage::create([
                'img_path' => $path,
                'facility_id' => $facility->id
            ]);
            File::put('assets/images/facilities/detail/' . $image_name, $data);
            $img->removeattribute('src');
            $img->setattribute('src', asset($path));
        }
        $body = $dom->savehtml();
        $facility->body = $body;
        $facility->save();

        DB::commit();

        FlashMessageHelper::bootstrapSuccessAlert('Data berhasil ditambahkan!');

        return redirect(route('admin.master.facility.index'));
    }

    public function edit($id)
    {
        $data = Facility::withTrashed()->findOrFail($id);

        return view('admin.pages.master.facility.edit', compact('data'));
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
        $facility = Facility::findOrFail($id);
        $facility->title = $request->title;
        if ($request->has('image')) {
            $imageUploadResult = ImageUploadHelper::upload($request->file('image'), 'assets/images/facilities/cover/', $facility->id . '-facility');
            $facility->img_path = '/' . $imageUploadResult['image_relative_path'];
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
                $image_name = $facility->id . '-' . $k . '-' . time() . '.png';
                $path = 'assets/images/facilities/detail/' . $image_name;
                FacilityImage::create([
                    'img_path' => $path,
                    'facility_id' => $facility->id
                ]);
                File::put('assets/images/facilities/detail/' . $image_name, $data);
                $img->removeattribute('src');
                $img->setattribute('src', asset($path));
            }
        }
        $body = $dom->savehtml();
        $facility->body = $body;
        $facility->save();
        DB::commit();

        FlashMessageHelper::bootstrapSuccessAlert('Data berhasil diubah!');
        return redirect(route('admin.master.facility.index'));
    }

    public function delete($id)
    {
        $facility = Facility::findOrFail($id);
        $facility->delete();

        FlashMessageHelper::bootstrapSuccessAlert('Data berhasil dihapus!');
        return redirect(route('admin.master.facility.index'));
    }

    public function restore($id)
    {
        $facility = Facility::onlyTrashed()->findOrFail($id);
        $facility->restore();

        FlashMessageHelper::bootstrapSuccessAlert('Data berhasil dikembalikan!');
        return redirect(route('admin.master.facility.index'));
    }
}
