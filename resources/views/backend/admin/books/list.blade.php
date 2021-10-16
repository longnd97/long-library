@extends('backend.layouts.master')
@section('title','Danh sách sách')
@section('content')
    <h1 class="mt-4">Danh sách sách</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Danh sách sách</li>
    </ol>
    @if (Session::has('success'))
        <p class="text-success" id="text-success">
            <i class="fa fa-check" aria-hidden="true"></i>
            {{ Session::get('success') }}
        </p>
    @endif
    <div class="card mb-4">
        @can('book-crud')
            <div class="card-header">
                <h3 class="card-title">
                    <a class="btn btn-success" href="{{ route('books.create') }}">Thêm mới</a>
                </h3>
            </div>
        @endcan
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách sách
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>STT</th>
                    <th width="150">Tên</th>
                    <th>Hình ảnh</th>
                    <th>Giá bán</th>
                    <th>Thể loại</th>
                    <th>Trạng thái</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($books as $key=>$book)
                    <tr id="book-{{$book->id}}">
                        <td>{{++$key}}</td>
                        <td>{{$book->name}}</td>
                        <td style="width: 150px"> @if($book->image)
                                <img src="{{ asset('storage/'.$book->image) }}" alt=""
                                     style="width: 100%">
                            @else
                                {{'Chưa có ảnh'}}
                            @endif</td>
                        <td>{{number_format($book->price)}}</td>
                        <td>{{$book->category->name}}</td>
                        <td>@if($book->status ==\App\Http\Controllers\BookConstant::BOOK_BORROWED)
                                <p class="text-success"><i class="fas fa-circle"></i> Có thể mượn</p>
                            @else
                                <p class="text-danger"><i class="fas fa-circle"></i> Chưa thể mượn</p>
                            @endif</td>
                        <td>
                            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#book-detail-{{$book->id}}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <div class="modal fade" id="book-detail-{{$book->id}}" data-bs-dismiss="modal" role="dialog"
                                 aria-labelledby="book-detail" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="book-detail">{{$book->name}}</h5>
                                        </div>
                                        <div class="modal-body">
                                            <b>Mô tả:</b><br>
                                            {{$book->desc}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @can('book-crud')
                                <a href="{{route('books.edit',['id'=>$book->id])}}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a data-id="{{$book->id}}"
                                   class="btn btn-danger delete-book">
                                    <i class="fas fa-trash"></i>
                                </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
