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
        <div class="dashboard-block mt-0">
            <h3 class="block-title">Giỏ hàng</h3>
            <nav class="list-nav">
                <ul>
                    <li class="active"><a href="javascript:void(0)">Số lượng <span>{{count($carts)}}</span></a></li>
                </ul>
            </nav>
            <!-- Start Items Area -->
            <form class="" action="">

            </form>
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
                        <div class="col-md-2 col-12">
                            <p>Tên sản phẩm</p>
                        </div>
                        <div class="col-md-2 col-12 ">
                            <p>Giá</p>
                        </div>
                        <div class="col-md-2 col-12 ">
                            <p>Số lượng</p>
                        </div>
                        <div class="col-md-1 col-12 ">
                            <p>Số lượng tồn</p>
                        </div>
                        <div class="col-md-2 col-12 ">
                            <p>Tổng</p>
                        </div>
                        <div class="col-md-1 col-12 ">
                            <p>Xóa</p>
                        </div>
                    </div>
                </div>
                <!-- End List Title -->
                <!-- Start Single List -->
                @foreach($carts as $cart)
                    <div class="single-item-list text-center">
                        <div class="row align-items-center">
                            <div class="col-1">{{ $loop->iteration }}</div>
                            <div class="col-md-1 col-12">
                                <img class="w-100 thumb-product" src="{{$cart->thumb}}" alt="{{$cart->nameProduct}}">
                            </div>
                            <div class="col-md-2 col-12">
                                <h6 class="title text-start"><a class="title-product" href="{{ route('products.details', ['slug' =>$cart->Product->slug]) }}">{{$cart->nameProduct}}</a></h6>
                            </div>
                            <div class="col-md-2 col-12">
                                <span class="price price-product">{{ number_format($cart->price) }} VNĐ</span>
                            </div>
                            <div class="col-md-2 col-12 product-infor form-add-to-cart" id="form-add-to-cart-{{$cart->id}}">
                                <div class="number mx-auto">
                                    <button type="button " class="decreaseButton" id="decreaseButton">-</button>
                                    <input name="quanity" class="quantity numberInput" type="number" inputmode="numeric" id="numberInput" data-cart-id="{{ $cart->id }}"
                                           value="{{ $cart->quanity }}" min="0">
                                    <button type="button " class="increaseButton" id="increaseButton">+</button>
                                </div>
                            </div>
                            <div class="col-md-1 col-12">
                                <span >{{ $cart->Product->Amounts }} </span>
                            </div>
                            <div class="col-md-2 col-12">
                                <span id="subtotal-{{ $cart->id }}" class="subtotal">{{ number_format($cart->subtotal) }} VNĐ</span>
                            </div>
                            <div class="col-md-1 col-12 align-right">
                                <form method="post" action="{{ route('carts.destroy', ['id' => $cart->id]) }}" class="action-btn text-center">
                                    @csrf
                                    @method('DELETE')
                                    <li>
                                        <button type="submit" class="border-0 bg-transparent">
                                            <i class="lni lni-trash"></i>
                                        </button>
                                    </li>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="d-flex justify-content-between  mt-3">
                    <a href="" id="updateCartButton" class="btn btn-success">Cập nhật</a>
                    <a href="" id="buy-products" class="btn btn-info">Mua hàng</a>
                </div>

                <!-- End Single List -->
                <!-- Pagination -->
                <div class="pagination left">
                    <div class="pagination mt-4 pb-4">
                        {{ $carts->links() }}
                    </div>
                </div>
                <!--/ End Pagination -->
            </div>
            <!-- End Items Area -->
        </div>

    </div>
@endsection
