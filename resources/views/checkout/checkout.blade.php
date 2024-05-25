@extends('layouts.layout')
@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{$title}}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="/">Trang chủ</a></li>
                        <li>{{$title}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="dashboard-block col-md-9 col-12 mt-0">
                <h3 class="block-title">Mua hàng</h3>

                <div class="my-items">
                    <!-- Start List Title -->
                    <div class="item-list-title">
                        <div class="row align-items-center text-center">
                            <div class="col-1 ">
                                <p>STT</p>
                            </div>
                            <div class="col-md-1 col-12">
                                <p>Ảnh</p>
                            </div>
                            <div class="col-md-4 col-12">
                                <p>Tên sản phẩm</p>
                            </div>
                            <div class="col-md-2 col-12 ">
                                <p>Giá</p>
                            </div>
                            <div class="col-md-2 col-12 ">
                                <p>Số lượng</p>
                            </div>
                            <div class="col-md-2 col-12 ">
                                <p>Tổng</p>
                            </div>
                        </div>
                    </div>
                    <!-- End List Title -->
                    <!-- Start Single List -->
                    <div class="infor-product-session"></div>
                    <div class="d-flex justify-content-end mt-4">
                        <div class="d-flex align-items-center">
                            <h5  class=" mb-0">Tổng tiền: </h5>
                            <h5 class="total mb-0 ms-2"></h5>
                        </div>

                    </div>

                </div>
                <!-- End Items Area -->
            </div>
            <div class="col-md-3 col-12">
                <ul id="nav" class="navbar-nav ms-auto mb-2">
                    <li class="nav-item">
                        <a class=" dd-menu collapsed py-2 fs-5" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#submenu-1-3" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">- Địa chỉ đã có:</a>
                        <ul class="sub-menu collapse" id="submenu-1-3">
                            @if(count($addresses) > 0)
                                @foreach($addresses as $address)
                                    <li data-address-id="{{$address->id}}" class="nav-item address-exist" id="address-exist-{{$address->id}}">
                                        <a href="javascript:void(0)">
                                            <span class="sdt">{{$address->sdt}}</span>
                                            <span class="name">{{$address->name}}</span>
                                            <span class="country">{{$address->Country}}</span>
                                            <span class="province">{{$address->province}}</span>
                                            <span class="district">{{$address->district}}</span>
                                            <span class="wards">{{$address->wards}}</span>
                                            <span class="address">{{$address->address}}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @else
                                <li  class="nav-item address-exist" >
                                    <a href="javascript:void(0)">
                                        Chưa có địa chỉ nào, vui lòng nhập địa chỉ!
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>

                </ul>

                <h5>- Nhập địa chỉ mới:</h5>
                <form method="post" action="{{route('checkout.checkout')}}" id="form-process-checkout" class=" mt-4">
                    @csrf
                    <div id="total-price"></div>
                    <div class="error">
                        @include('admin.error')
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label fw-bold text-dark fs-6">Số điện thoại</label>
                        <input type="text" name="sdt" class="input-field form-control input-sdt" data-required="Mời nhập số điện thoại" id="" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label fw-bold text-dark fs-6">Họ tên</label>
                        <input type="text" name="name" class="input-field form-control input-name" data-required="Mời nhập tên" id="" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label fw-bold text-dark fs-6">Đất nước</label>
                        <input type="text" name="Country" class="input-field form-control input-country" data-required="Mời nhập quốc gia" id="" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label fw-bold text-dark fs-6">Tỉnh / Thành phố</label>
                        <input type="text" name="province" class="input-field form-control input-province" data-required="Mời nhập tỉnh " id="" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label fw-bold text-dark fs-6">Quận / Huyện</label>
                        <input type="text" name="district" class="input-field form-control input-district" data-required="Mời nhập quận / huyện " id="" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label fw-bold text-dark fs-6">Xã / Phường</label>
                        <input type="text" name="wards" class="input-field form-control input-wards" data-required="Mời nhập xã / phường" id="" aria-describedby="emailHelp">
                    </div>
                    <div class="col-12">
                        <label for="" class="form-label fw-bold text-dark fs-6">Thôn / Xóm / Đường / Số nhà</label>
                        <input type="text" name="address" class="input-field form-control input-address" data-required="Mời nhập địa chỉ cụ thể" id="" aria-describedby="emailHelp">
                    </div>
                    <button class="btn btn-success btn-checkout float-end fw-bold mt-2" type="submit">Thanh toán</button>
                </form>
            </div>
        </div>
    </div>
@endsection
