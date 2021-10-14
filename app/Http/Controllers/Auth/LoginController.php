<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\FlashMessageHelper;
use App\Utils\ValidationHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginGet()
    {
        return view('auth.login');
    }

    public function loginPost(Request $request)
    {
        $validation = ValidationHelper::validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validation->fails()) {
            return ValidationHelper::validationError($validation);
        }

        $user = User::whereUsername($request->username)->first();
        if ($user == null) {
            FlashMessageHelper::bootstrapAlert([
                'class' => 'alert-danger',
                'icon' => 'error',
                'text' => 'Username atau password salah!'
            ]);
            return back();
        }
        if (!Hash::check($request->password, $user->password)) {
            FlashMessageHelper::bootstrapAlert([
                'class' => 'alert-danger',
                'icon' => 'error',
                'text' => 'Username atau password salah!'
            ]);
            return back();
        }
        $remember = $request->has('remember') ? true : false;
        Auth::loginUsingId($user->id, $remember);

        return redirect(route('admin.dashboard.index'));
    }

    public function logout()
    {
        auth()->logout();

        return redirect(route('auth.login.get'));
    }
}
