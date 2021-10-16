@extends('backend.layouts.master')
@section('title','Danh sách thể loại')
@section('content')
    <h1 class="mt-4">Danh sách thể loại</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Danh sách thể loại</li>
    </ol>
    @if (Session::has('success'))
        <p class="text-success">
            <i class="fa fa-check" aria-hidden="true"></i>
            {{ Session::get('success') }}
        </p>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">
                <a class="btn btn-success" href="{{ route('categories.create') }}">Thêm mới</a>
            </h3>
        </div>
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách thể loại
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $key=>$category)
                    <tr>
                        <td>{{++$key}}</td>
                        <td>{{$category->name}}</td>
                        <td>
                            <a href="{{route('categories.edit',['id'=>$category->id])}}"
                               class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{route('categories.destroy',['id'=>$category->id])}}"
                               onclick="return confirm('Bạn muốn xóa thể loại này?')"
                               class="btn btn-danger">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
