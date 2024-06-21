<header class="header navbar-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="nav-inner">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="/">
                            <img src="/temp/images/general/logo.png" alt="">
                        </a>
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a class=" active dd-menu collapsed"href="/">Trang chủ</a>
                                </li>
                                <li class="nav-item">
                                    <a class=" dd-menu collapsed" href="javascript:void(0)" data-bs-toggle="collapse" data-bs-target="#submenu-1-3" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">Sản phẩm</a>
                                    <ul class="sub-menu collapse" id="submenu-1-3">
                                        <li class="nav-item">
                                            <a href="{{ route('products.allProduct') }}">Tất cả sản phẩm</a>
                                        </li>
                                        @foreach($menus as $menu)
                                            @if($menu->parent_id == null)
                                                <li class="nav-item">
                                                    <a href="javascript:void(0)">{{$menu->title}}</a>
                                                    @if($menu->children->isNotEmpty())
                                                        <ul class="sub-menu collapse">
                                                            @foreach($menu->children as $child)
                                                                <li class="nav-item">
                                                                    <a href="{{ route('products.showProduct', ['categorySlug' => $child->slug]) }}">{{$child->title}}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class=" dd-menu collapsed" href="{{route('post')}}" >Tin tức</a>
                                </li>
                                <li class="nav-item">
                                    <a class=" dd-menu collapsed" href="/about">Giới thiệu</a>
                                </li>
                                <li class="nav-item">
                                    <a class=" dd-menu collapsed" href="/contact">Liên hệ</a>
                                </li>

                            </ul>
                        </div> <!-- navbar collapse -->
                        <div class="login-button d-flex align-items-center">
                            @auth
                                <p class="check-auth d-none">1</p>
                                <a href="{{route('carts.index')}}" class="me-4 position-relative">
                                    <span class="count-cart position-absolute end-0 d-flex justify-content-center align-items-center text-white bg-dark rounded-circle ms-2" style="width: 20px; height: 20px">{{ $count_cart }}</span>
                                    <span class=""></span>
                                    <svg style="width: 32px; height: 32px" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#363535" viewBox="0 0 256 256"><path d="M222.14,58.87A8,8,0,0,0,216,56H54.68L49.79,29.14A16,16,0,0,0,34.05,16H16a8,8,0,0,0,0,16h18L59.56,172.29a24,24,0,0,0,5.33,11.27,28,28,0,1,0,44.4,8.44h45.42A27.75,27.75,0,0,0,152,204a28,28,0,1,0,28-28H83.17a8,8,0,0,1-7.87-6.57L72.13,152h116a24,24,0,0,0,23.61-19.71l12.16-66.86A8,8,0,0,0,222.14,58.87ZM96,204a12,12,0,1,1-12-12A12,12,0,0,1,96,204Zm96,0a12,12,0,1,1-12-12A12,12,0,0,1,192,204Zm4-74.57A8,8,0,0,1,188.1,136H69.22L57.59,72H206.41Z"></path></svg>
                                </a>
                                <div class="dropdown">
                                    <button class="btn fw-bold dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="lni lni-user me-2"></i>
                                        <p>{{ Auth::user()->name }}</p>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="" class="dropdown-item" >Trang cá nhân</a>
                                        </li>
                                    </ul>
                                </div>
                                <form action="{{route('logout')}}" method="post" class="logout">
                                    @csrf
                                    <button type="submit" class="dropdown-item fw-bold">
                                        <i class="lni lni-enter"></i>
                                        Đăng xuất
                                    </button>
                                </form>
                            @else
                                <p class="check-auth d-none">0</p>
                                <ul>
                                    <li>
                                        <a href="{{route('login')}}"><i class="lni lni-enter"></i>Đăng nhập</a>
                                    </li>
                                    <li>
                                        <a href="{{route('register')}}"><i class="lni lni-user"></i>Đăng ký</a>
                                    </li>
                                </ul>
                            @endauth
                        </div>
                    </nav> <!-- navbar -->
                </div>
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</header>
