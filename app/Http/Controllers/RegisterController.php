<?php

namespace App\Http\Controllers;


use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;

class RegisterController extends Controller
{
    function showFormRegister()
    {
        return view('backend.admin.register');
    }

    function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->lastName . " " . $request->firstName;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->roles()->sync(3);
            DB::commit();
            } catch (Exception $exception) {
            DB::rollBack();
        }
        return redirect()->route('login');
    }
}
