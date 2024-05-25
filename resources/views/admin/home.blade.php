@extends('admin.main')
@section('contents')
    <!-- / Navbar -->
    <!-- Content wrapper -->
    <div class='content-wrapper'>
        <!-- Content -->
        <div class='container-xxl flex-grow-1 container-p-y'>
            <div class='row'>
                <div class='col-12 mb-4 order-0'>
                    <div class='card'>
                        <div class='d-flex align-items-end row'>
                            <div class='col-sm-7'>
                                <div class='card-body'>
                                    <h5
                                        class='card-title text-primary'
                                    >Chúc Mừng {{ Auth::user()->name }}! 🎉</h5>
                                    <p class='mb-4'>
                                        Hôm nay bạn đã bán được nhiều hơn 
                                        <span class='fw-bold'>72%</span>
                                        Kiểm tra huy hiệu mới của bạn trong.
                                        Hồ sơ của bạn.
                                    </p>
                                    <a
                                        href='javascript:;'
                                        class='btn btn-sm btn-outline-primary'
                                    >Xem Huy Hiệu</a>
                                </div>
                            </div>
                            <div class='col-sm-5 text-center text-sm-left'>
                                <div class='card-body pb-0 px-0 px-md-4'>
                                    <img
                                        src='/temp/admin/assets/img/illustrations/man-with-laptop-light.png'
                                        height='140'
                                        alt='View Badge User'
                                        data-app-dark-img='illustrations/man-with-laptop-dark.png'
                                        data-app-light-img='illustrations/man-with-laptop-light.png'
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='col-12 order-1'>
                    <h3>Thống kê</h3>
                    <div class='row'>
                        <div class='col-lg-3 col-md-12 col-6 mb-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div
                                        class='card-title d-flex align-items-start justify-content-between'
                                    >
                                        <div class='avatar flex-shrink-0'>
                                            <img
                                                src='/temp/admin/assets/img/icons/unicons/chart-success.png'
                                                alt='chart success'
                                                class='rounded'
                                            />
                                        </div>
                                        <div class='dropdown'>
                                            <button
                                                class='btn p-0'
                                                type='button'
                                                id='cardOpt3'
                                                data-bs-toggle='dropdown'
                                                aria-haspopup='true'
                                                aria-expanded='false'
                                            >
                                                <i
                                                    class='bx bx-dots-vertical-rounded'
                                                ></i>
                                            </button>
                                            <div
                                                class='dropdown-menu dropdown-menu-end'
                                                aria-labelledby='cardOpt3'
                                            >
                                                <a
                                                    class='dropdown-item'
                                                    href='{{route('user')}}'
                                                >Xem</a>

                                            </div>
                                        </div>
                                    </div>
                                    <span
                                        class='fw-semibold d-block mb-1'
                                    >Khách hàng </span>
                                    <h3 class='card-title mb-2'>{{count($user_count)}}</h3>
                                    <small class='text-success fw-semibold'><i
                                            class='bx bx-up-arrow-alt'
                                        ></i></small>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3 col-md-12 col-6 mb-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div
                                        class='card-title d-flex align-items-start justify-content-between'
                                    >
                                        <div class='avatar flex-shrink-0'>
                                            <img
                                                src='/temp/admin/assets/img/icons/unicons/wallet-info.png'
                                                alt='Credit Card'
                                                class='rounded'
                                            />
                                        </div>
                                        <div class='dropdown'>
                                            <button
                                                class='btn p-0'
                                                type='button'
                                                id='cardOpt6'
                                                data-bs-toggle='dropdown'
                                                aria-haspopup='true'
                                                aria-expanded='false'
                                            >
                                                <i
                                                    class='bx bx-dots-vertical-rounded'
                                                ></i>
                                            </button>
                                            <div
                                                class='dropdown-menu dropdown-menu-end'
                                                aria-labelledby='cardOpt6'
                                            >
                                                <a
                                                    class='dropdown-item'
                                                    href='{{route('products.index')}}'
                                                >Xem</a>

                                            </div>
                                        </div>
                                    </div>
                                    <span>Sản phẩm</span>
                                    <h3
                                        class='card-title text-nowrap mb-1'
                                    >{{count($product_count)}}</h3>
                                    <small class='text-success fw-semibold'><i
                                            class='bx bx-up-arrow-alt'
                                        ></i></small>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-3 col-md-12 col-6 mb-4'>
                            <div class='card'>
                                <div class='card-body'>
                                    <div
                                        class='card-title d-flex align-items-start justify-content-between'
                                    >
                                        <div class='avatar flex-shrink-0'>
                                            <img
                                                src='/temp/admin/assets/img/icons/unicons/wallet-info.png'
                                                alt='Credit Card'
                                                class='rounded'
                                            />
                                        </div>
                                        <div class='dropdown'>
                                            <button
                                                class='btn p-0'
                                                type='button'
                                                id='cardOpt6'
                                                data-bs-toggle='dropdown'
                                                aria-haspopup='true'
                                                aria-expanded='false'
                                            >
                                                <i
                                                    class='bx bx-dots-vertical-rounded'
                                                ></i>
                                            </button>
                                            <div
                                                class='dropdown-menu dropdown-menu-end'
                                                aria-labelledby='cardOpt6'
                                            >
                                                <a
                                                    class='dropdown-item'
                                                    href='{{route('posts.index')}}'
                                                >Xem</a>

                                            </div>
                                        </div>
                                    </div>
                                    <span>Bài viết</span>
                                    <h3
                                        class='card-title text-nowrap mb-1'
                                    >{{count($post)}}</h3>
                                    <small class='text-success fw-semibold'><i
                                            class='bx bx-up-arrow-alt'
                                        ></i></small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Total Revenue -->
                <!--/ Total Revenue -->
            </div>
        </div>
        <!-- / Content -->
        <!-- Footer -->
        <footer class='content-footer footer bg-footer-theme'>
            <div
                class='container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column'
            >
                <div class='mb-2 mb-md-0'>
                    ©
                    <script>
                        document.write(new Date().getFullYear());
                    </script>2023 ,  ❤️ 
                    <a
                        href='https://themeselection.com'
                        target='_blank'
                        class='footer-link fw-bolder'
                    >Lựa chọn chủ đề</a>
                </div>
                <div>
                    <a
                        href='https://themeselection.com/license/'
                        class='footer-link me-4'
                        target='_blank'
                    >Giấy phép</a>
                    <a
                        href='https://themeselection.com/'
                        target='_blank'
                        class='footer-link me-4'
                    >Thêm chủ đề</a>
                    <a
                        href='https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/'
                        target='_blank'
                        class='footer-link me-4'
                    >Tài liệu</a>
                    <a
                        href='https://github.com/themeselection/sneat-html-admin-template-free/issues'
                        target='_blank'
                        class='footer-link me-4'
                    >Ủng hộ</a>
                </div>
            </div>
        </footer>
        <!-- / Footer -->
        <div class='content-backdrop fade'></div>
    </div>
    <!-- Content wrapper -->
@endsection
