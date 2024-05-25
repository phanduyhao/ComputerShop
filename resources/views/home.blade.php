@extends('layouts.layout')
@section('content')
    <!-- Start Hero Area -->
    <section class="hero-area overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 offset-lg-1 col-md-12 col-12">
                    <div class="hero-text text-center">
                        <!-- Start Hero Text -->
                        <div class="section-heading">
                            <h2 class="wow fadeInUp" data-wow-delay=".3s">Chào mừng đến với Văn Hiệp - Computer</h2>
                            <p class="wow fadeInUp" data-wow-delay=".5s">Bán các loại máy tính, laptop và các linh kiện liên quan.</p>
                        </div>
                        <!-- End Search Form -->
                        <!-- Start Search Form -->
                        <form action="{{route('search')}}" method="get" class="search-form wow fadeInUp" data-wow-delay=".7s">
                            @csrf
                            <div class="row">
                                <div class="col-lg-10 col-md-8 col-12 p-0">
                                    <div class="search-input">
                                        <label for="keyword"><i class="lni lni-search-alt theme-color"></i></label>
                                        <input type="text" name="keyword" id="keyword" placeholder="Từ khóa sản phẩm">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12 p-0">
                                    <div class="search-btn button">
                                        <button type="submit" class="btn"><i class="lni lni-search-alt"></i> Tìm Kiếm</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- End Search Form -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero Area -->

    <!-- Start Categories Area -->
    <section class="categories">
        <div class="container">
            <div class="cat-inner">
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="category-slider">
                            <!-- Start Single Category -->
                            <a href="category.html" class="single-cat">
                                <div class="icon">
                                    <img src="/temp/images/icon/icon1.png" alt="#">
                                </div>
                                <h3>Máy tính bàn</h3>
                            </a>
                            <!-- End Single Category -->
                            <!-- Start Single Category -->
                            <a href="category.html" class="single-cat">
                                <div class="icon">
                                    <img src="/temp/images/icon/icon2.png" alt="#">
                                </div>
                                <h3>Máy tính xách tay</h3>
                            </a>
                            <!-- End Single Category -->
                            <!-- Start Single Category -->
                            <a href="category.html" class="single-cat">
                                <div class="icon">
                                    <img src="/temp/images/icon/icon3.png" alt="#">
                                </div>
                                <h3>Chuột</h3>
                            </a>
                            <!-- End Single Category -->
                            <!-- Start Single Category -->
                            <a href="category.html" class="single-cat">
                                <div class="icon">
                                    <img src="/temp/images/icon/icon4.png" alt="#">
                                </div>
                                <h3>Bàn phím</h3>
                            </a>
                            <!-- End Single Category -->
                            <!-- Start Single Category -->
                            <a href="category.html" class="single-cat">
                                <div class="icon">
                                    <img src="/temp/images/icon/icon5.png" alt="#">
                                </div>
                                <h3>Tai nghe</h3>
                            </a>
                            <!-- End Single Category -->
                            <!-- Start Single Category -->
                            <a href="category.html" class="single-cat">
                                <div class="icon">
                                    <img src="/temp/images/icon/icon6.png" alt="#">
                                </div>
                                <h3>Màn hình</h3>
                            </a>
                            <!-- End Single Category -->
                            <!-- Start Single Category -->
                            <a href="category.html" class="single-cat">
                                <div class="icon">
                                    <img src="/temp/images/icon/icon7.png" alt="#">
                                </div>
                                <h3>Ram</h3>
                            </a>
                            <!-- End Single Category -->
                            <!-- Start Single Category -->
                            <a href="category.html" class="single-cat">
                                <div class="icon">
                                    <img src="/temp/images/icon/icon8.png" alt="#">
                                </div>
                                <h3>Ổ đĩa</h3>
                            </a>
                            <!-- End Single Category -->
                            <!-- Start Single Category -->
                            <a href="category.html" class="single-cat">
                                <div class="icon">
                                    <img src="/temp/images/icon/icon9.png" alt="#">
                                </div>
                                <h3>Pin</h3>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /End Categories Area -->

    <!-- Start Items Grid Area -->
    <section class="items-grid section custom-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Sản phẩm Hot</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">Đây là những sản phẩm đang rất hot và nhiều người săn đón trên thị trường.</p>
                    </div>
                </div>
            </div>
            <div class="single-head">
                <div class="row ">
                    @foreach($product_hots as $product_hot)
                        <div class="col-lg-4 col-md-6 col-12 product-infor-main" id="product-infor-hot-{{$product_hot->id}}">
                            <input type="number" hidden class="quantity" value="1">
                            <!-- Start Single Item -->
                            <div class="single-item-grid ">
                                <div class="image">
                                    <a href="{{ route('products.details', ['slug' =>$product_hot->slug]) }}">
                                        <img class="thumb-product" src="/temp/images/product/{{$product_hot->thumb}}" alt="{{$product_hot->title}}"></a>
                                    <i class=" cross-badge lni lni-bolt"></i>
                                    @if($product_hot->discount > 0)
                                        <span class="flat-badge sale">Sale</span>
                                    @endif
                                </div>
                                <div class="content">
                                    <a href="{{ route('products.showProduct', ['categorySlug' => $product_hot->Category->slug]) }}" class="tag cate-product">{{$product_hot->Category->title}}</a>
                                    <h3 class="title">
                                        <a class="title-product" href="{{ route('products.details', ['slug' =>$product_hot->slug]) }}">{{$product_hot->Title}}</a>
                                    </h3>
                                    <p class="location"><a href="javascript:void(0)"><i class="lni lni-map-marker">
                                            </i>Nghệ An</a></p>
                                    <ul class="info">
                                        @if($product_hot->discount > 0)
                                            <li class="discount text-dark text-decoration-line-through">{{ number_format($product_hot->price) }} VNĐ</li>
                                        @endif
                                        <li class="okPrice-product price">{{ number_format($product_hot->discount) }} VNĐ</li>
                                        <li class="like">
                                            <a data-user-id="{{ Auth::id() }}" data-product-id="{{$product_hot->id}}" data-quantity="{{$product_hot->Amounts}}" href="javascript:void(0)" class="add-to-cart">
                                                <svg style="width: 22px; height: 22px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#363535" viewBox="0 0 256 256"><path d="M222.14,58.87A8,8,0,0,0,216,56H54.68L49.79,29.14A16,16,0,0,0,34.05,16H16a8,8,0,0,0,0,16h18L59.56,172.29a24,24,0,0,0,5.33,11.27,28,28,0,1,0,44.4,8.44h45.42A27.75,27.75,0,0,0,152,204a28,28,0,1,0,28-28H83.17a8,8,0,0,1-7.87-6.57L72.13,152h116a24,24,0,0,0,23.61-19.71l12.16-66.86A8,8,0,0,0,222.14,58.87ZM96,204a12,12,0,1,1-12-12A12,12,0,0,1,96,204Zm96,0a12,12,0,1,1-12-12A12,12,0,0,1,192,204Zm4-74.57A8,8,0,0,1,188.1,136H69.22L57.59,72H206.41Z"></path></svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Single Item -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- /End Items Grid Area -->

    <!-- Start Items Grid Area -->
    <section class="items-grid section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2 class="wow fadeInUp" data-wow-delay=".4s">Sản phẩm mới nhất</h2>
                        <p class="wow fadeInUp" data-wow-delay=".6s">Đây là những sản phẩm mới ra mắt và nhiều người săn đón trên thị trường.</p>
                    </div>
                </div>
            </div>
            <div class="single-head">
                <div class="row ">
                    @foreach($product_news as $product_new)
                        <div class="col-lg-4 col-md-6 col-12 product-infor-main" id="product-infor-new-{{$product_new->id}}">
                            <input type="number" hidden class="quantity" value="1">

                            <!-- Start Single Item -->
                            <div class="single-item-grid">
                                <div class="image">
                                    <a href="{{ route('products.details', ['slug' =>$product_new->slug]) }}">
                                        <img class="thumb-product" src="/temp/images/product/{{$product_new->thumb}}" alt="{{$product_new->title}}"></a>
                                    <i class=" cross-badge lni lni-bolt"></i>
                                    @if($product_new->discount > 0)
                                        <span class="flat-badge sale">Sale</span>
                                    @endif
                                </div>
                                <div class="content">
                                    <a href="{{ route('products.showProduct', ['categorySlug' => $product_new->slug]) }}" class="tag cate-product">{{$product_new->Category->title}}</a>
                                    <h3 class="title">
                                        <a class="title-product" href="{{ route('products.details', ['slug' =>$product_new->slug]) }}">{{$product_new->Title}}</a>
                                    </h3>
                                    <p class="location"><a href="javascript:void(0)"><i class="lni lni-map-marker">
                                            </i>Nghệ An</a></p>
                                    <ul class="info">
                                        @if($product_new->discount > 0)
                                            <li class="discount text-dark text-decoration-line-through">{{ number_format($product_new->price) }} VNĐ</li>
                                        @endif
                                        <li class="price okPrice-product">{{ number_format($product_new->discount) }} VNĐ</li>
                                        <li class="like">
                                            <a data-user-id="{{ Auth::id() }}" data-product-id="{{$product_new->id}}" href="javascript:void(0)" class="add-to-cart">
                                                <svg style="width: 22px; height: 22px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#363535" viewBox="0 0 256 256"><path d="M222.14,58.87A8,8,0,0,0,216,56H54.68L49.79,29.14A16,16,0,0,0,34.05,16H16a8,8,0,0,0,0,16h18L59.56,172.29a24,24,0,0,0,5.33,11.27,28,28,0,1,0,44.4,8.44h45.42A27.75,27.75,0,0,0,152,204a28,28,0,1,0,28-28H83.17a8,8,0,0,1-7.87-6.57L72.13,152h116a24,24,0,0,0,23.61-19.71l12.16-66.86A8,8,0,0,0,222.14,58.87ZM96,204a12,12,0,1,1-12-12A12,12,0,0,1,96,204Zm96,0a12,12,0,1,1-12-12A12,12,0,0,1,192,204Zm4-74.57A8,8,0,0,1,188.1,136H69.22L57.59,72H206.41Z"></path></svg>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- End Single Item -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- /End Items Grid Area -->

    <!-- Start Call Action Area -->
    <section class="call-action overlay section">
        <div class="container">
            <div class="row ">
                <div class="col-lg-8 offset-lg-2 col-12">
                    <div class="inner">
                        <div class="content">
                            <h2 class="wow fadeInUp" data-wow-delay=".4s">Hãy lựa chọn cho mình<br>
                                những sản phẩm tốt nhất</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Call Action Area -->
    <section class="categories">
        <div class="container">
            <div class="cat-inner">
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="tns-outer" id="tns1-ow"><div class="tns-controls" aria-label="Carousel Navigation" tabindex="0"><button type="button" data-controls="prev" tabindex="-1" aria-controls="tns1"><i class="lni lni-chevron-left"></i></button><button type="button" data-controls="next" tabindex="-1" aria-controls="tns1"><i class="lni lni-chevron-right"></i></button></div><div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide <span class="current">12 to 17</span>  of 9</div><div id="tns1-mw" class="tns-ovh"><div class="tns-inner" id="tns1-iw"><div class="category-slider  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal" id="tns1" style="transform: translate3d(-35.4839%, 0px, 0px);"><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon8.png" alt="#">
                                            </div>
                                            <h3>Ổ đĩa</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon9.png" alt="#">
                                            </div>
                                            <h3>Pin</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon1.png" alt="#">
                                            </div>
                                            <h3>Máy tính bàn</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon2.png" alt="#">
                                            </div>
                                            <h3>Máy tính xách tay</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon3.png" alt="#">
                                            </div>
                                            <h3>Chuột</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon4.png" alt="#">
                                            </div>
                                            <h3>Bàn phím</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon5.png" alt="#">
                                            </div>
                                            <h3>Tai nghe</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon6.png" alt="#">
                                            </div>
                                            <h3>Màn hình</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon7.png" alt="#">
                                            </div>
                                            <h3>Ram</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon8.png" alt="#">
                                            </div>
                                            <h3>Ổ đĩa</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon9.png" alt="#">
                                            </div>
                                            <h3>Pin</h3>
                                        </a>
                                        <!-- Start Single Category -->
                                        <a href="category.html" class="single-cat tns-item tns-slide-active" id="tns1-item0">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon1.png" alt="#">
                                            </div>
                                            <h3>Máy tính bàn</h3>
                                        </a>
                                        <!-- End Single Category -->
                                        <!-- Start Single Category -->
                                        <a href="category.html" class="single-cat tns-item tns-slide-active" id="tns1-item1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon2.png" alt="#">
                                            </div>
                                            <h3>Máy tính xách tay</h3>
                                        </a>
                                        <!-- End Single Category -->
                                        <!-- Start Single Category -->
                                        <a href="category.html" class="single-cat tns-item tns-slide-active" id="tns1-item2">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon3.png" alt="#">
                                            </div>
                                            <h3>Chuột</h3>
                                        </a>
                                        <!-- End Single Category -->
                                        <!-- Start Single Category -->
                                        <a href="category.html" class="single-cat tns-item tns-slide-active" id="tns1-item3">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon4.png" alt="#">
                                            </div>
                                            <h3>Bàn phím</h3>
                                        </a>
                                        <!-- End Single Category -->
                                        <!-- Start Single Category -->
                                        <a href="category.html" class="single-cat tns-item tns-slide-active" id="tns1-item4">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon5.png" alt="#">
                                            </div>
                                            <h3>Tai nghe</h3>
                                        </a>
                                        <!-- End Single Category -->
                                        <!-- Start Single Category -->
                                        <a href="category.html" class="single-cat tns-item tns-slide-active" id="tns1-item5">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon6.png" alt="#">
                                            </div>
                                            <h3>Màn hình</h3>
                                        </a>
                                        <!-- End Single Category -->
                                        <!-- Start Single Category -->
                                        <a href="category.html" class="single-cat tns-item" id="tns1-item6" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon7.png" alt="#">
                                            </div>
                                            <h3>Ram</h3>
                                        </a>
                                        <!-- End Single Category -->
                                        <!-- Start Single Category -->
                                        <a href="category.html" class="single-cat tns-item" id="tns1-item7" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon8.png" alt="#">
                                            </div>
                                            <h3>Ổ đĩa</h3>
                                        </a>
                                        <!-- End Single Category -->
                                        <!-- Start Single Category -->
                                        <a href="category.html" class="single-cat tns-item" id="tns1-item8" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon9.png" alt="#">
                                            </div>
                                            <h3>Pin</h3>
                                        </a>
                                        <a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon1.png" alt="#">
                                            </div>
                                            <h3>Máy tính bàn</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon2.png" alt="#">
                                            </div>
                                            <h3>Máy tính xách tay</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon3.png" alt="#">
                                            </div>
                                            <h3>Chuột</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon4.png" alt="#">
                                            </div>
                                            <h3>Bàn phím</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon5.png" alt="#">
                                            </div>
                                            <h3>Tai nghe</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon6.png" alt="#">
                                            </div>
                                            <h3>Màn hình</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon7.png" alt="#">
                                            </div>
                                            <h3>Ram</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon8.png" alt="#">
                                            </div>
                                            <h3>Ổ đĩa</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon9.png" alt="#">
                                            </div>
                                            <h3>Pin</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon1.png" alt="#">
                                            </div>
                                            <h3>Máy tính bàn</h3>
                                        </a><a href="category.html" class="single-cat tns-item tns-slide-cloned" aria-hidden="true" tabindex="-1">
                                            <div class="icon">
                                                <img src="/temp/images/icon/icon2.png" alt="#">
                                            </div>
                                            <h3>Máy tính xách tay</h3>
                                        </a></div></div></div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
