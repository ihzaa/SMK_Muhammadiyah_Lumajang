<?php

namespace App\Http\Controllers\Admin\UserConfig;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\FlashMessageHelper;
use App\Utils\ValidationHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->has('status')) {
                $query = User::onlyTrashed();
                return datatables()->of($query)
                    ->addColumn('status', function ($obj) {
                        if ($obj->trashed()) {
                            return 'Dihapus';
                        } else {
                            return 'Aktif';
                        }
                    })
                    ->addColumn('action', function ($obj) {
                        return '<a class="btn btn-sm btn-success" href="' . route('admin.user_config.user.show', ['id' => $obj->id]) . '" data-toggle="tooltip" data-placement="top" title="Lihat Detail"><i class="far fa-eye"></i></a>';
                    })
                    ->editColumn('created_at', function ($data) {
                        return Carbon::parse($data->created_at)->format('d-m-Y');
                    })
                    ->make(true);
            }
            $query = User::query();
            return datatables()->of($query)
                ->addColumn('status', function ($obj) {
                    if ($obj->trashed()) {
                        return 'Dihapus';
                    } else {
                        return 'Aktif';
                    }
                })
                ->addColumn('action', function ($obj) {
                    return '<a class="btn btn-sm btn-success" href="' . route('admin.user_config.user.show', ['id' => $obj->id]) . '" data-toggle="tooltip" data-placement="top" title="Lihat Detail"><i class="far fa-eye"></i></a>';
                })
                ->editColumn('created_at', function ($data) {
                    return Carbon::parse($data->created_at)->format('d-m-Y');
                })
                ->make(true);
        }

        return view('admin.pages.user_configuration.user.index');
    }

    public function createGet()
    {
        $data['roles'] = Role::get();
        return view('admin.pages.user_configuration.user.create', compact('data'));
    }

    public function createPost(Request $request)
    {
        $validate = ValidationHelper::validate($request, [
            'name' => 'required',
            'username' => 'required|unique:' . User::getTableName(),
            'email' => 'required|email|unique:' . User::getTableName(),
            'password' => 'required|string|min:8',
            'role' => 'required'
        ], [], [
            'name' => 'nama',
            'role' => 'peran'
        ]);

        if ($validate->fails()) {
            return ValidationHelper::validationError($validate);
        }

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        $role = Role::find($request->role);
        $user->assignRole($role);
        $user->save();

        FlashMessageHelper::bootstrapAlert([
            'class' => 'alert-success',
            'icon' => 'plus',
            'text' => 'User ' . $request->name . ' berhasil ditambahkan!'
        ]);

        return redirect(route('admin.user_config.user.index'));
    }

    public function show($id)
    {
        $data['obj'] = User::withTrashed()->find($id);
        $data['roles'] = Role::pluck('name', 'id');
        $data['user_role'] = $data['obj']->getRoleNames();
        return view('admin.pages.user_configuration.user.show', compact('data'));
    }

    public function update($id, Request $request)
    {
        $user = User::find($id);
        $validate = ValidationHelper::validate($request, [
            'name' => 'required',
            'email' => ['required', Rule::unique(User::getTableName())->ignore($user)],
            'password' => 'nullable|string|min:8',
            'role' => 'required'
        ], [], ['name' => 'nama', 'role' => 'peran']);

        if ($validate->fails()) {
            return ValidationHelper::validationError($validate);
        }

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('role'));
        $user->save();

        FlashMessageHelper::bootstrapAlert([
            'class' => 'alert-success',
            'icon' => 'save',
            'text' => 'User ' . $request->name . ' berhasil diubah!'
        ]);

        return back();
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        FlashMessageHelper::bootstrapAlert([
            'class' => 'alert-success',
            'icon' => 'trash-alt',
            'text' => 'User ' . $user->name . ' berhasil dihapus!'
        ]);

        return redirect(route('admin.user_config.user.index'));
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->first();
        $user->restore();

        FlashMessageHelper::bootstrapAlert([
            'class' => 'alert-success',
            'icon' => 'trash-restore-alt',
            'text' => 'User ' . $user->name . ' berhasil dikembalikan!'
        ]);

        return redirect(route('admin.user_config.user.show', ['id' => $id]));
    }
}
