@extends('backend.layouts.master')
@section('title','Chỉnh sửa thể loại')
@section('content')
    <h1 class="mt-4">Chỉnh sửa thể loại</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active"><a href="{{route('categories.index')}}">Danh sách thể loại</a></li>
        <li class="breadcrumb-item active">Chỉnh sửa thể loại</li>
    </ol>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <p class="card-title">Thêm mới thể loại</p>
                    </div>
                    <div class="card-body">
                        <form class="form" method="post">
                            @csrf
                            <div class="form-group">
                                <lable>Tên</lable>
                                <strong class="text-danger">*</strong>
                                <input type="text" value="{{$category->name}}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name">
                                @error('name')
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
