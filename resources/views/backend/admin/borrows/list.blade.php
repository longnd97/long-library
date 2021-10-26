@extends('backend.layouts.master')
@section('title','Danh sách phiếu mượn')
@section('content')
    <h1 class="mt-4">Danh sách phiếu mượn</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Danh sách phiếu mượn</li>
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
                <a class="btn btn-success" href="{{ route('borrows.create') }}">Thêm mới</a>
            </h3>
        </div>
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Danh sách phiếu mượn
        </div>
        <div class="card-body">
            <table id="datatablesSimple">
                <thead>
                <tr>
                    <th>Mã phiếu mượn</th>
                    <th>Sinh viên mượn</th>
                    <th>Ngày mượn</th>
                    <th>Ngày trả</th>
                    <th>Trạng thái</th>
                    <th>Xác nhận đã trả</th>
                </tr>
                </thead>
                <tbody>@foreach($borrows as $key=>$borrow)
                    @if($borrow->status==\App\Http\Controllers\BorrowConstant::BORROWED)
                        <tr>
                            <td>@if($key<9) <a href="" data-bs-toggle="modal" data-bs-target="#borrow-detail-{{$borrow->id}}">{{'PM00'.++$key}}</a>
                                @else {{'PM0'.++$key}}
                                @endif
                            </td>
                            <div class="modal fade" id="borrow-detail-{{$borrow->id}}" data-bs-dismiss="modal" role="dialog"
                                 aria-labelledby="borrow-detail" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="borrow-detail">Chi tiết phiếu mượn</h5>
                                        </div>
                                        <div class="modal-body">
                                            <b>Sách đang mượn:</b>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <td>{{$borrow->student->name}}</td>
                            <td>{{date('d-m-Y',strtotime($borrow->borrow_date))}}</td>
                            <td>{{date('d-m-Y',strtotime($borrow->return_date))}}</td>
                            @if(Carbon\Carbon::now()>$borrow->return_date)
                                <td class="text-danger"><i class="fas fa-circle"></i> Quá hạn trả</td>
                            @else
                                <td class="text-success"><i class="fas fa-circle"></i> Đang mượn</td>
                            @endif
                            <td><a data-id="{{$borrow->id}}" class="confirm-return btn btn-success"
                                   style="margin-left: 50px">
                                    <i class="fas fa-check"></i>
                                </a></td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
