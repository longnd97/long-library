@extends('backend.layouts.master')
@section('title', 'Thêm mới người dùng')
@section('content')
    <h1 class="mt-4">Thêm mới người dùng</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active"><a href="{{route('users.index')}}">Danh sách người dùng</a></li>
        <li class="breadcrumb-item active">Thêm mới người dùng</li>
    </ol>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <p class="card-title">Thêm mới người dùng</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('users.store') }}" class="form" method="post">
                            @csrf
                            <div class="form-group">
                                <lable>Tên</lable>
                                <strong class="text-danger">*</strong>
                                <input type="text" value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name">
                                @error('name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <lable>Role</lable>
                                <strong class="text-danger">*</strong>
                                @foreach($roles as $role)
                                    <div class="form-check">
                                        <input name="role[{{$role->id}}]" class="form-check-input"
                                               type="checkbox"
                                               value="{{ $role->id }}" id="role-{{$role->id}}">
                                        <label class="form-check-label" for="role-{{$role->id}}">
                                            {{ $role->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <lable>Email</lable>
                                <strong class="text-danger">*</strong>
                                <input type="email" value="{{ old('email') }}"
                                       class="form-control @error('email') is-invalid  @enderror"
                                       name="email">
                                @error('email')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <lable>Mật khẩu</lable>
                                <strong class="text-danger">*</strong>
                                <input type="password" class="form-control" name="password">
                                @error('password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <lable>Nhập lại mật khẩu</lable>
                                <strong class="text-danger">*</strong>
                                <input type="password" class="form-control" name="password_confirmation">
                                @error('password')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            </br>
                            <button type="submit" class="btn btn-primary">Lưu</button>
                            <button class="btn btn-secondary"
                                    onclick="window.history.go(-1); return false;">Hủy
                            </button>
                            <p>Trường <strong class="text-danger"> * </strong> là trường bắt buộc!</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection
