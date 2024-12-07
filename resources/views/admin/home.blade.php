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
                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Tổng doanh thu</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/assets/img/money.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        
                                    </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{ number_format((float)str_replace(',', '', $tongdoanhthu), 0, ',', '.') }} đ</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Doanh thu tháng này</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/assets/img/money.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        
                                    </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{ number_format((float)str_replace(',', '', $tongdoanhthuThangNay), 0, ',', '.') }} đ</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Doanh thu hôm nay</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/assets/img/money.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        
                                    </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{ number_format((float)str_replace(',', '', $tongdoanhthuHomNay), 0, ',', '.') }} đ</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Tài khoản quản trị</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/assets/img/user.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        
                                    </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_userAdmin}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Tài khoản khách hàng</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/assets/img/user.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        
                                    </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_user}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Danh mục sản phẩm</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/assets/img/cate.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        
                                    </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_cate}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Loại sản phẩm</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/assets/img/product.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        
                                    </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_type_product}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Tổng số lượng sản phẩm</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/assets/img/products.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        
                                    </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_products}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Số đơn hàng</span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/assets/img/order.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        
                                    </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_order}}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-12 col-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title d-flex align-items-start justify-content-between">
                                    <span class="fw-semibold d-block mb-1 fs-5">Bài viết </span>

                                        <div class="avatar flex-shrink-0">
                                            <img
                                            src='/temp/assets/img/news.png'
                                            alt='chart success'
                                            class='rounded'
                                        />                                        
                                    </div>
                                    </div>
                                    <h3 class="card-title mb-2">{{$count_post}}</h3>
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
