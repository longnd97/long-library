@extends('backend.layouts.master')
@section('title', 'Chỉnh sửa thông tin người dùng')
@section('content')
    <h1 class="mt-4">Chỉnh sửa thông tin người dùng</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active"><a href="{{route('users.index')}}">Danh sách người dùng
                dùng</a></li>
        <li class="breadcrumb-item active">Chỉnh sửa thông tin người dùng</li>
    </ol>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Chỉnh sửa thông tin người dùng</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form class="form" method="post">
                            @csrf
                            <div class="form-group">
                                <lable>Tên</lable>
                                <input type="text" value="{{ $user->name }}"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="name">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <lable>Email</lable>
                                <input type="email" value="{{ $user->email }}"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email">
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <lable>Role</lable>
                                @foreach($roles as $role)
                                    <div class="form-check">
                                        <input
                                            @if($user->checkRole($role->id))
                                            checked
                                            @endif
                                            name="role[{{$role->id}}]" class="form-check-input"
                                            type="checkbox"
                                            value="{{ $role->id }}" id="role-{{$role->id}}">
                                        <label class="form-check-label" for="role-{{$role->id}}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <button class="btn btn-secondary"
                                    onclick="window.history.go(-1); return false;">Hủy
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
