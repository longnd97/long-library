@extends('backend.layouts.master')
@section('title','Danh sách phiếu đã trả')
@section('content')
    <h1 class="mt-4">Danh sách phiếu đã trả</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active">Danh sách đã trả</li>
    </ol>
    <div class="card mb-4">
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
                </tr>
                </thead>
                <tbody>@foreach($borrows as $key=>$borrow)
                    @if($borrow->status==\App\Http\Controllers\BorrowConstant::BORROW_RETURN)
                        <tr>
                            <td>@if($key<9) {{'PM00'.++$key}}
                                @else {{'PM0'.++$key}}
                                @endif
                            </td>
                            <td>{{$borrow->student->name}}</td>
                            <td>{{date('d-m-Y',strtotime($borrow->borrow_date))}}</td>
                            <td>{{date('d-m-Y',strtotime($borrow->return_date))}}</td>
                            <td class="text-success"><i class="fas fa-circle"></i> Đã trả</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
