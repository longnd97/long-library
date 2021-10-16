@extends('backend.layouts.master')
@section('title','Danh sách sinh viên')
@section('content')
    <h1 class="mt-4">Danh sách sinh viên</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Danh sách sinh viên</li>
    </ol>
    @if (Session::has('success'))
        <p class="text-success">
            <i class="fa fa-check" aria-hidden="true"></i>
            {{ Session::get('success') }}
        </p>
    @endif
    <div class="card mb-4">
        @can('student-crud')
            <div class="card-header">
                <h3 class="card-title">
                    <a class="btn btn-success" href="{{ route('students.create') }}">Thêm mới</a>
                </h3>
            </div>
        @endcan
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách sinh viên
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Ảnh</th>
                    <th>Tên sinh viên</th>
                    <th>Mã sinh viên</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($students as $key=>$student)
                    <tr id="student-{{$student->id}}">
                        <td>{{++$key}}</td>
                        <td style="width: 150px"> @if($student->avatar)
                                <img src="{{ asset('storage/'.$student->avatar) }}" style="width: 40%">
                            @else
                                <img src="{{asset('storage/avatars/avatar.jpg')}}" style="width: 40%">
                            @endif
                        </td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->student_code}}</td>
                        <td>
                            <a class="btn btn-success" data-bs-toggle="modal"
                               data-bs-target="#student-detail-{{$student->id}}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <div class="modal fade" id="student-detail-{{$student->id}}" data-bs-dismiss="modal"
                                 role="dialog"
                                 aria-labelledby="student-detail" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="student-detail">Thông
                                                tin sinh viên</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-6"> @if($student->avatar)
                                                            <img src="{{ asset('storage/'.$student->avatar) }}"
                                                                 style="width: 40%">
                                                        @else
                                                            <img src="{{asset('storage/avatars/avatar.jpg')}}"
                                                                 style="width: 80%">
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        <b>Tên sinh viên: </b>
                                                        {{$student->name}}
                                                        <br>
                                                        <b>Mã sinh viên: </b>
                                                        {{$student->student_code}}
                                                        <br>
                                                        <b>Email: </b>
                                                        {{$student->email}}
                                                        <br>
                                                        <b>Địa chỉ: </b>
                                                        {{$student->address}}
                                                        <br>
                                                        <b>Số điện thoại </b>
                                                        {{$student->phone}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @can('student-crud')
                                <a href="{{route('students.edit',['id'=>$student->id])}}" class="btn btn-primary">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a data-id="{{$student->id}}"
                                   class="btn btn-danger delete-student">
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
