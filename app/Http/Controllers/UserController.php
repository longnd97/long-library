<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Mockery\Exception;

class UserController extends Controller implements BaseInterface
{
    function index()
    {
        if (Gate::allows('user-crud')) {
            $users = User::all();
            return view('backend.admin.users.list', compact('users'));
        } else {
            abort(403);
        }
    }

    function create()
    {
        if (Gate::allows('user-crud')) {
            $roles = Role::all();
            return view('backend.admin.users.add', compact('roles'));
        } else {
            abort(403);
        }
    }

    function store(CreateUserRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make('$request->password');
            $user->save();
            $user->roles()->sync($request->role);
            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
        }
        Session::flash('success', 'Tạo mới người dùng thành công');
        return redirect()->route('users.index');
    }

    function edit($id)
    {
        if (Gate::allows('user-crud')) {
            $user = User::findOrFail($id);
            $roles = Role::all();
            return view('backend.admin.users.update', compact('user', 'roles'));
        } else {
            abort(403);
        }
    }

    function update(UpdateUserRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            $user->roles()->sync($request->role);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
        }
        Session::flash('success', 'Cập nhật người dùng thành công');
        return redirect()->route('users.index');
    }

    function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();
        return response()->json('Xóa thành công');
    }
}
