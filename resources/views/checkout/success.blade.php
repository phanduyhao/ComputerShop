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
    <div class="success-info text-center mt-5">
        <span>
            <svg style="width: 100px; height: 100px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#32a71b" viewBox="0 0 256 256"><path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm45.66,85.66-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35a8,8,0,0,1,11.32,11.32Z"></path></svg>
        </span>
        <h1 class="mt-3">THÀNH CÔNG</h1>
    </div>
    <div class="container my-5">
        <div class="dashboard-block  mt-0">
            <h3 class="block-title">Đơn hàng</h3>

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

                <h4 class="mt-4 mb-3">Địa chỉ người nhận: </h4>
                <div class="infor-address-session"></div>

                <div class="d-flex justify-content-between mt-4">
                    <div class="d-flex align-items-center">
                        <h5 class="time-checkout">Thời gian thanh toán: </h5>
                        <h5> {{$time}}</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <h5  class=" mb-0">Tổng tiền: </h5>
                        <h5 class="total mb-0 ms-2"></h5>
                    </div>

                </div>

            </div>
            <!-- End Items Area -->
        </div>
    </div>
@endsection
