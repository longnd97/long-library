<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Services\LoginService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    function showFormLogin()
    {
        return view('backend.admin.login');
    }

    function login(LoginRequest $request)
    {
        if ($this->loginService->checkLogin($request)) {
            return redirect()->route('home.index');
        }
        Session::flash('login_error', 'Sai tài khoản hoặc mật khẩu vui lòng thử lại');
        return back();
    }

    public function showFormChangePassword()
    {
        return view('backend.admin.changePassword');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = Auth::user();
        $currentPassword = $user->password;
        if (!Hash::check($request->currentPassword, $currentPassword)) {
            return redirect()->back()->withErrors(['currentPassword' => 'Sai mật khẩu hiện tại']);
        }
        $user->password = Hash::make($request->newPassword);
        $user->save();
        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
