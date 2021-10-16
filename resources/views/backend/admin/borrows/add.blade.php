@extends('backend.layouts.master')
@section('title','Thêm mới phiếu mượn')
@section('content')
    <h1 class="mt-4">Thêm mới phiếu mượn</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{route('home.index')}}">Trang chủ</a></li>
        <li class="breadcrumb-item active"><a href="{{route('borrows.index')}}">Danh sách phiếu mượn</a>
        </li>
        <li class="breadcrumb-item active">Thêm mới phiếu mượn</li>
    </ol>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <p class="card-title">Thêm mới phiếu mượn</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control"
                                               id="search-student-borrow"
                                               placeholder="Tìm tên học sinh, mã học sinh">
                                    </div>
                                    <ul id="list-student-borrow-search"
                                        style="position: absolute;z-index: 1000"
                                        class="list-group"></ul>
                                </div>
                                <div class="form-group">
                                    <hr>
                                    <h6>Thông tin người mượn</h6>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label">Tên học
                                            viên</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="name"
                                                   id="name-student-borrow" disabled>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="email"
                                               class="col-sm-4 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" name="email"
                                                   id="email-student-borrow" disabled>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-group row">
                                        <label for="phone"
                                               class="col-sm-4 col-form-label">Phone</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="phone"
                                                   id="phone-student-borrow" disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" id="search-book"
                                               placeholder="Tìm tên sách">
                                    </div>
                                    <ul id="list-book-search"
                                        style="position: absolute;z-index: 1000"
                                        class="list-group"></ul>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <h6>Danh sách sách</h6>

                                    <hr>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Tên sách</th>
                                            <th>Hình ảnh</th>
                                            <th>Trạng thái</th>
                                            <th><a id="book-cancel" class="btn btn-outline-danger btn-sm"><i class="fas fa-times"></i></a>
                                            </th>
                                        </tr>
                                        <tr>
                                            <td style="text-align: center" colspan="3" id="choseBook">Vui lòng chọn
                                                sách
                                            </td>
                                        </tr>
                                        <tbody id="book-item">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12">
                            <div class="form-group">
                                <h6>Thông tin phiếu mượn</h6>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <input type="text" id="student-id" hidden>
                                    <input type="text" id="book-id" hidden>
                                    <input type="text" id="book-status" hidden>
                                    <div class="form-group row">
                                        <label for="borrow_date" class="col-sm-4 col-form-label">Ngày
                                            mượn</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control"
                                                   name="borrow_date"
                                                   id="borrow_date">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="borrow_return" class="col-sm-4 col-form-label">Ngày
                                            trả</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control"
                                                   name="return_date"
                                                   id="return_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="form-group">
                                        <button id="create-borrow" class="btn btn-success" type="submit">Cho mượn
                                        </button>
                                        <button class="btn btn-secondary"
                                                onclick="window.history.go(-1); return false;">Hủy
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
