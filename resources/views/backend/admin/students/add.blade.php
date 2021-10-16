@extends('backend.layouts.master')
@section('title','Thêm mới sinh viên')
@section('content')
    <h1 class="mt-4">Thêm mới sinh viên</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active"><a href="{{route('students.index')}}">Danh sách sinh viên</a>
        </li>
        <li class="breadcrumb-item active">Thêm mới sinh viên</li>
    </ol>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <p class="card-title">Thêm mới sinh viên</p>
                    <form action="{{ route('students.store') }}" class="form" method="post"
                          enctype="multipart/form-data">
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
                            <label>Mã sinh viên</label>
                            <strong class="text-danger">*</strong>
                            <input type="text" value="{{ old('student_code') }}"
                                   class="form-control @error('student_code') is-invalid  @enderror"
                                   name="student_code">
                            @error('student_code')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <strong class="text-danger">*</strong>
                            <input type="email" value="{{old('email')}}"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email">
                            @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <strong class="text-danger">*</strong>
                            <input type="text" value="{{ old('address') }}"
                                   class="form-control @error('address') is-invalid  @enderror"
                                   name="address">
                            @error('address')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <strong class="text-danger">*</strong>
                            <input type="text" value="{{ old('phone') }}"
                                   class="form-control @error('phone') is-invalid  @enderror"
                                   name="phone">
                            @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        </br>
                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <input type="file" name="avatar" class="form-control-file">
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
@endsection
