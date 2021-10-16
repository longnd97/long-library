@extends('backend.layouts.master')
@section('title','Danh sách người dùng')
@section('content')
    <h1 class="mt-4">Danh sách người dùng</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Danh sách người dùng</li>
    </ol>
    @if (Session::has('success'))
        <p class="text-success" id="text-success">
            <i class="fa fa-check" aria-hidden="true"></i>
            {{ Session::get('success') }}
        </p>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">
                <a class="btn btn-success" href="{{ route('users.create') }}">Thêm mới</a>
            </h3>
        </div>
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách người dùng
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Chức vụ</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key=>$user)
                    @if($user->name!='Admin')
                    <tr class="user-item" id="user-{{$user->id}}">
                        <td>{{$key++}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if(count($user->roles) > 0)
                                @foreach($user->roles as $role)
                                    {{ $role->name . ',' }}
                                @endforeach
                            @else
                                {{'Chưa phân loại'}}
                            @endif
                        </td>
                        <td>
                            <a href="{{route('users.edit',['id'=>$user->id])}}" class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a data-id="{{$user->id}}"
                               class="btn btn-danger delete-user">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
