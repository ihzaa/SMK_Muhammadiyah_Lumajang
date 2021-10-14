<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Slider;
use App\Utils\FlashMessageHelper;
use App\Utils\ImageUploadHelper;
use App\Utils\ValidationHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Slider::query();
            if ($request->status == 'delete') {
                $query = $query->onlyTrashed();
            } else if ($request->status == '') {
                $query = $query->withTrashed();
            }
            return datatables()->of($query)
                ->addColumn('status', function ($obj) {
                    if ($obj->trashed()) {
                        return 'Dihapus';
                    } else {
                        return 'Aktif';
                    }
                })
                ->addColumn('action', function ($obj) {
                    $btnEdit = $obj->deleted_at == null ? '<a class="btn btn-sm mr-1 btn-success" href="' . route('admin.master.slider.edit', ['id' => $obj->id]) . '" data-toggle="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-pencil-alt"></i></a>' : '';
                    $bntHapus = $obj->deleted_at == null ? '<a class="btn btn-sm mr-1 btn-danger" href="' . route('admin.master.slider.delete', [$obj->id]) . '" onclick="return confirm(\'Yakin hapus data?\')" data-toggle="tooltip" data-placement="top" title="Hapus Data"><i class="fa fa-trash"></i></a>' : '';
                    $btnRestore =  $obj->deleted_at == null ? '' : '<a class="btn btn-sm btn-secondary" href="' . route('admin.master.slider.restore', [$obj->id]) . '" onclick="return confirm(\'Yakin mengembalikan data?\')" data-toggle="tooltip" data-placement="top" title="Kembalikan Data"><i class="fa fa-trash-restore"></i></a>';
                    $allBtn = $btnEdit . $bntHapus . $btnRestore;
                    return $allBtn;
                })
                ->editColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->format('d-m-Y');
                })
                ->editColumn('img_path', function ($data) {
                    return '<a href="' . asset($data->img_path) . '" data-lightbox="image-' . $data->id . '" data-title="' . $data->name . '"><img class="img-fluid" src="' . $data->thumbnail() . '"/></a>';
                })
                ->rawColumns(['img_path', 'action'])
                ->make(true);
        }
        return view('admin.pages.master.slider.index');
    }

    public function create(Request $request)
    {
        return view('admin.pages.master.slider.create');
    }

    public function store(Request $request)
    {
        $validate = ValidationHelper::validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'max' => 'Ukuran :attribute tidak boleh lebih dari :max KB'
        ], [
            'image' => 'Foto'
        ]);

        if ($validate->fails()) {
            return ValidationHelper::validationError($validate);
        }
        DB::beginTransaction();
        $slider = Slider::create([
            'name' => $request->name,
        ]);
        $imageUploadResult = ImageUploadHelper::upload($request->file('image'), 'assets/images/sliders/', $slider->id . '-slider');
        $slider->img_path = '/' . $imageUploadResult['image_relative_path'];
        $slider->save();
        DB::commit();
        FlashMessageHelper::bootstrapSuccessAlert('Slider berhasil ditambahkan!');
        return redirect(route('admin.master.slider.index'));
    }

    public function edit($id)
    {
        $data = Slider::findOrFail($id);

        return view('admin.pages.master.slider.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $validate = ValidationHelper::validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'max' => 'Ukuran :attribute tidak boleh lebih dari :max KB'
        ], [
            'image' => 'Foto'
        ]);

        if ($validate->fails()) {
            return ValidationHelper::validationError($validate);
        }
        $slider =  Slider::findOrFail($id);
        $data['name'] = $request->name;
        if ($request->has('image')) {
            $imageUploadResult = ImageUploadHelper::upload($request->file('image'), 'assets/images/sliders/', $id . '-slider');
            $data['img_path'] = '/' . $imageUploadResult['image_relative_path'];
            // File::delete($slider->img_path, $slider->thumbnail());
        }
        $slider->update($data);

        FlashMessageHelper::bootstrapSuccessAlert('Slider berhasil diubah!');
        return redirect(route('admin.master.slider.index'));
    }

    public function delete($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete($id);

        FlashMessageHelper::bootstrapSuccessAlert('Slider berhasil dihapus!');
        return redirect(route('admin.master.slider.index'));
    }

    public function restore($id)
    {
        $slider = Slider::onlyTrashed()->findOrFail($id);
        $slider->restore($id);

        FlashMessageHelper::bootstrapSuccessAlert('Slider berhasil dikembalikan!');
        return redirect(route('admin.master.slider.index'));
    }
}
