<?php

namespace App\Http\Controllers\Admin\UserConfig;

use App\Http\Controllers\Controller;
use App\Utils\FlashMessageHelper;
use App\Utils\ValidationHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $query = Role::orderBy('name');
            return datatables()->of($query)
                ->addColumn('action', function ($data) {
                    if ($data->id == 1)
                        return 'Memiliki semua izin.';
                    return '<a class="btn btn-sm btn-success" href="' . route('admin.user_config.permission.show', [$data->id]) . '" data-toggle="tooltip" data-placement="top" title="Lihat Detail"><i class="far fa-eye"></i></a>';
                })
                ->editColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->format('d-m-Y');
                })
                ->make(true);
        }

        return view('admin.pages.user_configuration.permission.index');
    }

    public function show($id)
    {
        $data['role'] = Role::find($id);
        $data['rolePermissions'] = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
            ->where("role_has_permissions.role_id", $id)
            ->pluck('name', 'id');
        $data['permission'] = Permission::get();

        return view('admin.pages.user_configuration.permission.show', compact('data'));
    }

    public function update($id, Request $request)
    {
        $validator = ValidationHelper::validate(
            $request,
            [
                'permission' => 'required|array',
                'name' => 'required'
            ],
            [],
            ['name' => 'Nama Peran']
        );
        if ($validator->fails()) {
            return ValidationHelper::validationError($validator);
        }

        $role = Role::find($id);
        $role->name = $request->name;
        $role->syncPermissions($request->input('permission'));
        $role->save();
        FlashMessageHelper::bootstrapAlert(['class' => 'alert-success', 'icon' => 'pen', 'text' => 'Berhasil merubah perizian ' . $request->name . '!']);

        return redirect(route('admin.user_config.permission.index'));
    }

    public function delete($id)
    {
        $role = Role::find($id);
        $name = $role->name;
        $role->delete();
        FlashMessageHelper::bootstrapAlert(['class' => 'alert-success', 'icon' => 'trash', 'text' => 'Berhasil menghapus perizinan ' . $name . '!']);
        return redirect(route('admin.user_config.permission.index'));
    }

    public function createGet()
    {
        $data['permission'] = Permission::get();
        return view('admin.pages.user_configuration.permission.create', compact('data'));
    }

    public function createPost(Request $request)
    {
        $validator = ValidationHelper::validate(
            $request,
            [
                'permission' => 'required|array',
                'name' => 'required'
            ],
            [],
            ['name' => 'Nama Peran']
        );
        if ($validator->fails()) {
            return ValidationHelper::validationError($validator);
        }

        $role = Role::create([
            'name' => $request->name
        ]);

        $role->syncPermissions($request->input('permission'));
        $role->save();

        FlashMessageHelper::bootstrapAlert(['class' => 'alert-success', 'icon' => 'plus', 'text' => 'Berhasil menambahkan perizian ' . $request->name . '!']);

        return redirect(route('admin.user_config.permission.index'));
    }
}
