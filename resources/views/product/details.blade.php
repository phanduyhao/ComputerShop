@extends('layouts.layout')
@section('content')
    <!-- Start Breadcrumbs -->
    <div class="breadcrumbs">
        <div class="container">
            <ul class="breadcrumb-nav text-start">
                <li><a href="/">Trang chủ</a></li>
                <li>{{$title}}</li>
            </ul>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- Start Item Details -->
    <section class="item-details section">
        <div class="container">
            <div class="top-area">
                <div class="row product-infor-main product-infor" id="product-infor-detail">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div class="main-img">
                                    <img class="thumb-product" src="/temp/images/product/{{$product->thumb}}" id="current" alt="#">
                                </div>
                            </main>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                            <h2 class="title title-product">{{$product->Title}}</h2>
                            <p class="location"><i class="lni lni-map-marker"></i><a href="javascript:void(0)">Nghệ An</a></p>
                            @if($product->discount > 0)
                                <h4 class="discount text-dark text-decoration-line-through">{{ number_format($product->price) }} VNĐ</h4>
                                <h3 class="price okPrice-product">{{ number_format($product->discount) }} VNĐ</h3>
                            @else
                                <h3 class="price okPrice-product">{{ number_format($product->price) }} VNĐ</h3>
                            @endif
                            <h3 class="price"></h3>
                            @if($product->Amounts > 0)
                                <h6 class="mt-3">Số lượng: {{$product->Amounts}}</h6>
                            @else
                                <h6 class="text-danger mt-3">Hết hàng</h6>
                            @endif
                            <div class="list-info">
                                <h4>Ưu đãi</h4>
                                <div>
                                    {!! $product->description !!}
                                </div>
                            </div>
                            <div class="contact-info">
                                <ul>
                                    <li>
                                        <div class="d-flex form-add-to-cart" id="form-add-to-cart-details">
                                            @if($product->Amounts > 0)
                                            <div class="number me-3">
                                                <button type="button " class="decreaseButton" id="decreaseButton">-</button>
                                                <input name="quanity" class="quantity numberInput" type="number" inputmode="numeric" id="numberInput" value="0" min="0">
                                                <button type="button " class="increaseButton" id="increaseButton">+</button>
                                            </div>
                                                <a href="" data-user-id="{{ Auth::id() }}" data-product-id="{{$product->id}}" data-quantity="{{$product->Amounts}}" class="btn rounded-2 add-to-cart call d-flex align-items-center px-3 py-2">
                                                    <svg style="width: 24px; height: 24px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#e6e6e6" viewBox="0 0 256 256"><path d="M96,216a16,16,0,1,1-16-16A16,16,0,0,1,96,216Zm88-16a16,16,0,1,0,16,16A16,16,0,0,0,184,200ZM230.44,67.25A8,8,0,0,0,224,64H48.32L40.21,35.6A16.08,16.08,0,0,0,24.82,24H8A8,8,0,0,0,8,40H24.82L61,166.59A24.11,24.11,0,0,0,84.07,184h96.11a23.89,23.89,0,0,0,22.94-16.94l28.53-92.71A8,8,0,0,0,230.44,67.25Z"></path></svg>
                                                    <span class="ms-2 fw-bold fs-6">Thêm vào giỏ</span>
                                                </a>
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="social-share">
                                <h4>Chia sẻ sản phẩm</h4>
                                <ul>
                                    <li><a href="javascript:void(0)" class="facebook"><i class="lni lni-facebook-filled"></i></a></li>
                                    <li><a href="javascript:void(0)" class="twitter"><i class="lni lni-twitter-original"></i></a></li>
                                    <li><a href="javascript:void(0)" class="google"><i class="lni lni-google"></i></a></li>
                                    <li><a href="javascript:void(0)" class="linkedin"><i class="lni lni-linkedin-original"></i></a></li>
                                    <li><a href="javascript:void(0)" class="pinterest"><i class="lni lni-pinterest"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item-details-blocks">
                <div class="row">
                    <div class="col-lg-8 col-md-7 col-12">
                        <!-- Start Single Block -->
                        <div class="single-block description">
                            <h3>Thông tin chi tiết</h3>
                            {!! $product->content !!}
                        </div>
                        <!-- End Single Block -->
                        <!-- Start Single Block -->
                        <div class="single-block comments">
                            <h3>Bình luận</h3>
                            <!-- Start Single Comment -->
                            <div class="single-comment">
                                <img src="assets/images/testimonial/testi2.jpg" alt="#">
                                <div class="content">
                                    <h4>hào</h4>
                                    <span>24 tuổi, 2024</span>
                                    <p>
                                        Bạn hào đẹp trai, học giỏi, hát hay.
                                    </p>
                                    <a href="javascript:void(0)" class="reply"><i class="lni lni-reply"></i> Trả lời</a>
                                </div>
                            </div>
                            <!-- End Single Comment -->
                        </div>
                        <!-- End Single Block -->
                        <!-- Start Single Block -->
                        <div class="single-block comment-form">
                            <h3>Đăng bình luận</h3>
                            <form action="#" method="POST">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <div class="form-box form-group">
                                            <input type="text" name="name" class="form-control form-control-custom"
                                                   placeholder="Tên của bạn" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <div class="form-box form-group">
                                            <input type="email" name="email" class="form-control form-control-custom"
                                                   placeholder="Email của bạn" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-box form-group">
                                            <textarea name="#" class="form-control form-control-custom"
                                                      placeholder="Bình Luận"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="button">
                                            <button type="submit" class="btn">Đăng bình luận</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- End Single Block -->
                    </div>
                    <div class="col-lg-4 col-md-5 col-12">
                        <div class="item-details-sidebar">
                            <!-- Start Single Block -->
                            <div class="single-block thongsokythuat">
                                <h3>Thông số kỹ thuật</h3>
                                <div class="content">
                                    {!! $product->thongsokythuat !!}
                                </div>
                            </div>
                            <!-- End Single Block -->
                            <!-- Start Single Block -->
                            <div class="single-block contant-seller comment-form ">
                                <h3>Liên hệ với người bán</h3>
                                <form action="#" method="POST">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-box form-group">
                                                <input type="text" name="name" class="form-control form-control-custom"
                                                       placeholder="Tên của bạn" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-box form-group">
                                                <input type="email" name="email"
                                                       class="form-control form-control-custom" placeholder="Email của bạn" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-box form-group">
                                                <textarea name="#" class="form-control form-control-custom"
                                                          placeholder="Tin nhắn của bạn"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="button">
                                                <button type="submit" class="btn">Gửi tin nhắn</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- End Single Block -->
                            <!-- Start Single Block -->
                            <div class="single-block ">
                                <h3>Vị trí</h3>
                                <div class="mapouter">
                                    <div class="gmap_canvas"><iframe width="100%" height="300" id="gmap_canvas"
                                                                     src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed"
                                                                     frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a
                                            href="https://putlocker-is.org"></a><br>
                                        <style>
                                            .mapouter {
                                                position: relative;
                                                text-align: right;
                                                height: 300px;
                                                width: 100%;
                                            }
                                        </style><a href="https://www.embedgooglemap.net">Mã google map website</a>
                                        <style>
                                            .gmap_canvas {
                                                overflow: hidden;
                                                background: none !important;
                                                height: 300px;
                                                width: 100%;
                                            }
                                        </style>
                                    </div>
                                </div>
                            </div>
                            <!-- End Single Block -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
