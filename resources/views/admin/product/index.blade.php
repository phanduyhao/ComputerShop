@extends('admin.main')
@section('contents')
    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Danh sách sản phẩm</h5>
                <div>
                    <button type="button" data-id="" class="btn btn-success text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#createProduct" >Thêm mới</button>
                    <button type="button"class="btn btn-danger me-2 px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModalAll">Xóa tất cả</button>
                    <div class="modal fade" id="deleteModalAll" tabindex="-1" aria-labelledby="deleteModalAllLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa tất cả sản phẩm không ?</h1>
                                </div>
                                <form action="{{route('deleteAllProduct')}}" method="post" class="modal-footer">
                                    @csrf
                                    <button class="delete-forever btn btn-danger fw-bolder">Xóa</button>
                                    <button type="button" class="btn btn-secondary fw-bolder" data-bs-dismiss="modal">Đóng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

{{--            Thêm mới --}}
            <div class="modal fade" id="createProduct" tabindex="-1" aria-labelledby="createProductLabel" aria-hidden="true" style="overflow-x:hidden !important">
                <div class="modal-dialog" style="max-width: 1440px">
                    <div class="modal-content">
                        <div class="modal-header border-bottom">
                            <h1 class="modal-title fs-5" id="createProductLabel">Thêm mới sản phẩm.</h1>
                        </div>
                            <div class="nav mt-3 d-flex justify-content-center" id="nav-tab" role="tablist">
                                <button class="nav-link text-uppercase border-0 bg-white fw-bold active me-3" id="basic-info-tab" data-bs-toggle="tab" data-bs-target="#basic-info" type="button" role="tab" aria-controls="basic-info" aria-selected="true">Thông tin cơ bản</button>
                                <button class="nav-link me-3 text-uppercase border-0 bg-white fw-bold" id="content-details-tab" data-bs-toggle="tab" data-bs-target="#content-details" type="button" role="tab" aria-controls="content-details" aria-selected="false">Nội dung chi tiết</button>
                                <button class="nav-link text-uppercase border-0 bg-white fw-bold" id="thongsokythuat-tab" data-bs-toggle="tab" data-bs-target="#thongsokythuat" type="button" role="tab" aria-controls="thongsokythuat" aria-selected="false">Thông số kỹ thuật</button>
                            </div>
                        <div class="card-body">
                            <div class="error">
                                @include('admin.error')
                            </div>
                            <form id="form_product_store" class="form-create" method='POST' enctype="multipart/form-data" action='{{route('products.store')}}'>
                                @csrf
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-info-tab" tabindex="0">
                                        <div class="mb-3 d-flex flex-column image-gallery" id="image-gallery-form_product_store">
                                            <label
                                                class='form-label'
                                                for='basic-default-fullname'
                                            >Ảnh</label>
                                            <input type="file" name="thumb" class="file-input" id="file-input-form_product_store" multiple onchange="previewImages(event, 'form_product_store')">
                                            <div class="image-preview" id="image-preview-form_product_store"></div>
                                        </div>
                                        <div class='mb-3 w-100 me-3'>
                                            <label
                                                class='form-label'
                                                for='basic-default-fullname'
                                            >Tiêu đề</label>
                                            <input
                                                type='text'
                                                class='form-control title input-field '
                                                id='title-store'
                                                placeholder='Nhập tiêu đề'
                                                name='title' data-require='Mời nhập Tiêu đề'
                                            />
                                        </div>
                                        <div class='mb-3 w-100'>
                                                <label
                                                    class='form-label'
                                                    for='basic-default-company'
                                                >Slug</label>
                                                <input
                                                    type='text'
                                                    class='form-control slug input-field'
                                                    id='slug-store'
                                                    placeholder='Nhập Slug'
                                                    name='slug' data-require='Mời nhập Slug'
                                                />
                                            </div>
                                        <div class='mb-3'>
                                            <div class="form-group">
                                                <label class="mb-3" for="">Mô tả</label>
                                                <textarea name="desc" class="form-control ckeditor-desc ckeditor"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class='form-label'
                                                   for='basic-default-email'>Danh mục</label>
                                            <select name="cate_id" class="form-control" id="cate_id">
                                                <option value="">Chọn danh mục</option>
                                                @foreach($cates as $cate)
                                                    <option value="{{ $cate->id }}">{{ $cate->id }}-{{ $cate->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="d-flex mb-3 ">
                                            <div class='me-3'>
                                                <label
                                                    class='form-label'
                                                    for='basic-default-email'
                                                >Giá gốc ( VND )</label>
                                                <div class='input-group input-group-merge'>
                                                    <input
                                                        type='text'
                                                        id='price'
                                                        class='form-control'
                                                        name='price'
                                                    />
                                                </div>
                                            </div>
                                            <div class='me-3'>
                                                <label
                                                    class='form-label'
                                                    for='basic-default-email'
                                                >Giá giảm ( VND )</label>
                                                <div class='input-group input-group-merge'>
                                                    <input
                                                        type='text'
                                                        id='discount'
                                                        class='form-control'
                                                        name='discount'
                                                    />
                                                </div>
                                            </div>
                                            <div class=''>
                                                <label
                                                    class='form-label'
                                                    for='basic-default-email'
                                                >Số lượng</label>
                                                <div class='input-group input-group-merge'>
                                                    <input
                                                        type='text'
                                                        id='amount'
                                                        class='form-control'
                                                        name='amount'
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex mb-3 ">
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="checkbox" id="active" name="active">
                                                <label class="form-check-label" for="defaultCheck3"> Hoạt động </label>
                                            </div>
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="checkbox" id="ishot" name="ishot">
                                                <label class="form-check-label" for="defaultCheck3"> Đang Hot </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="isnewfeed" name="isnewfeed">
                                                <label class="form-check-label" for="defaultCheck3"> Mới nhất </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="content-details" role="tabpanel" aria-labelledby="content-details-tab" tabindex="0">
                                        <div class="form-group">
                                            <label class="mb-3" for="">Nội dung</label>
                                            <textarea name="content" class="form-control ckeditor-content ckeditor"></textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="thongsokythuat" role="tabpanel" aria-labelledby="thongsokythuat-tab" tabindex="0">
                                        <div class="form-group">
                                            <label class="mb-3" for="">Thông số kỹ  thuật</label>
                                            <textarea name="thongsokythuat" class="form-control ckeditor-thongsokythuat ckeditor"></textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type='submit' class='btn btn-success fw-semibold text-dark'>Thêm mới</button>
                                    <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Đóng</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>Ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Danh mục</th>
                        <th>Giá gốc</th>
                        <th>Giá giảm</th>
                        <th>Hoạt động</th>
                        <th>Đang Hot</th>
                        <th>Mới nhất</th>
                        <th>Số lượng</th>
                        <th>Thao tác</th>

                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($products as $product)
                        <tr data-id="{{$product->id}}">
                            <td> {{ $loop->iteration }}</td>
                            <td>
                                <img width="100" src="/temp/images/product/{{$product->thumb}}" alt="{{ $product->title }}'s Thumb">
                            </td>
                            <td width="250px">{{$product->Title}}</td>
                            <td>
                                @if($product->cate_id != null)
                                    {{$product->Category->title}}
                                @else
                                    Chưa chọn danh mục
                                @endif
                            </td>
                            <td>{{ number_format($product->price) }} VNĐ</td>
                            <td>{{ number_format($product->discount) }} VNĐ</td>

                            <td>
                                @if($product->active == 1)
                                    <i class='bx bxs-circle text-success'></i>
                                @else
                                    <i class='bx bxs-circle text-danger'></i>
                                @endif
                            </td>
                            <td>
                                @if($product->ishot == 1)
                                    <i class='bx bxs-circle text-success'></i>
                                @else
                                    <i class='bx bxs-circle text-danger'></i>
                                @endif
                            </td>
                            <td>
                                @if($product->isnewfeed == 1)
                                    <i class='bx bxs-circle text-success'></i>
                                @else
                                    <i class='bx bxs-circle text-danger'></i>
                                @endif
                            </td>
                            <td>
                                {{ $product->Amounts }}
                            </td>
                            <td class="">
                                <button type="button" data-url="/admin/products/{{$product->id}}" data-id="{{$product->id}}" class="btn btn-danger btnDeleteAsk me-2 px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa</button>
                                <button type="button" data-id="{{$product->id}}" class="btn btn-edit btn-info btnEditProduct text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#editProduct{{$product->id}}">Sửa</button>
                            </td>
                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true" style="overflow-x:hidden !important">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="delete-forever btn btn-danger" data-id="{{ $product->id }}">Xóa</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>

                        <!-- Modal Edit -->
                    @endforeach
                    </tbody>
                </table>

{{--                Sửa --}}
                @foreach($products as $product)
                    <div class="modal fade" id="editProduct{{$product->id}}" aria-labelledby="editProduct{{$product->id}}Label" style="overflow-x:hidden !important">
                        <div class="modal-dialog" style="max-width: 1440px">
                            <div class="modal-content">
                                <div class="modal-header border-bottom">
                                    <h1 class="modal-title fs-5" id="createProductLabel">Chỉnh sửa sản phẩm.</h1>
                                </div>
                                <div class="nav mt-3 d-flex justify-content-center" id="{{$product->id}}-nav-tab" role="tablist">
                                    <button class="nav-link text-uppercase border-0 bg-white fw-bold active me-3" id="basic-info-{{$product->id}}-tab" data-bs-toggle="tab" data-bs-target="#basic-info-{{$product->id}}" type="button" role="tab" aria-controls="basic-info-{{$product->id}}" aria-selected="true">Thông tin cơ bản</button>
                                    <button class="nav-link me-3 text-uppercase border-0 bg-white fw-bold" id="content-details-{{$product->id}}-tab" data-bs-toggle="tab" data-bs-target="#content-details-{{$product->id}}" type="button" role="tab" aria-controls="content-details-{{$product->id}}" aria-selected="false">Nội dung chi tiết</button>
                                    <button class="nav-link text-uppercase border-0 bg-white fw-bold" id="thongsokythuat-{{$product->id}}-tab" data-bs-toggle="tab" data-bs-target="#thongsokythuat-{{$product->id}}" type="button" role="tab" aria-controls="thongsokythuat-{{$product->id}}" aria-selected="false">Thông số kỹ thuật</button>
                                </div>
                                <div class="card-body">
                                    <div class="error">
                                        @include('admin.error')
                                    </div>
                                    <form class="form_product_update form-edit" id="form_product_update-{{$product->id}}" class="form-create" method='POST' enctype="multipart/form-data" action='{{route('products.update',['product' => $product])}}'>
                                        @method('Patch')
                                        @csrf
                                        <div class="tab-content" id="{{$product->id}}-nav-tabContent">
                                            <div class="tab-pane fade show active" id="basic-info-{{$product->id}}" role="tabpanel" aria-labelledby="basic-info-{{$product->id}}-tab" tabindex="0">
                                                <div class="mb-3 d-flex flex-column image-gallery" id="image-gallery-{{$product->id}}">
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-fullname'
                                                    >Ảnh</label>
                                                    <input type="file" name="thumb" class="file-input" id="file-input-{{$product->id}}" multiple onchange="previewImages(event, {{$product->id}})">
                                                    <div class="image-preview" id="image-preview-{{$product->id}}"></div>
                                                </div>
                                                <div class='mb-3 w-100 me-3'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-fullname'
                                                    >Tiêu đề</label>
                                                    <input
                                                        type='text'
                                                        class='form-control title input-field '
                                                        id='title-edit-{{$product->id}}'
                                                        placeholder='Nhập tiêu đề'
                                                        value="{{$product->Title}}"
                                                        name='title' data-require='Mời nhập Tiêu đề'
                                                    />
                                                </div>
                                                <div class='mb-3 w-100'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-company'
                                                    >Slug</label>
                                                    <input
                                                        type='text'
                                                        class='form-control slug input-field'
                                                        id='slug-edit-{{$product->id}}'
                                                        value="{{$product->slug}}"
                                                        placeholder='Nhập Slug'
                                                        name='slug' data-require='Mời nhập Slug'
                                                    />
                                                </div>
                                                <div class='mb-3'>
                                                    <div class="form-group">
                                                        <label class="mb-3" for="">Mô tả</label>
                                                        <textarea name="desc" class="form-control ckeditor-desc ckeditor"> {!! $product->description !!}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class='form-label'
                                                           for='basic-default-email'>Danh mục</label>
                                                    <select name="cate_id" class="form-control" id="cate_id-{{$product->id}}">
                                                        @if($product->cate_id != null)
                                                            <option value="{{ $product->Category->id }}">{{ $product->Category->id }}-{{ $product->Category->title }}</option>
                                                        @else
                                                            <option value="">Chọn danh mục/option>
                                                        @endif
                                                        @foreach($cates as $cate)
                                                            <option value="{{ $cate->id }}">{{ $cate->id }}-{{ $cate->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="d-flex mb-3 ">
                                                    <div class='me-3'>
                                                        <label
                                                            class='form-label'
                                                            for='basic-default-email'
                                                        >Giá gốc ( VND )</label>
                                                        <div class='input-group input-group-merge'>
                                                            <input
                                                                type='text'
                                                                id='price-{{$product->id}}'
                                                                value="{{$product->price}}"
                                                                class='form-control'
                                                                name='price'
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class='me-3'>
                                                        <label
                                                            class='form-label'
                                                            for='basic-default-email'
                                                        >Giá giảm ( VND )</label>
                                                        <div class='input-group input-group-merge'>
                                                            <input
                                                                type='text'
                                                                id='discount-{{$product->id}}'
                                                                value="{{$product->discount}}"
                                                                class='form-control'
                                                                name='discount'
                                                            />
                                                        </div>
                                                    </div>
                                                    <div class=''>
                                                        <label
                                                            class='form-label'
                                                            for='basic-default-email'
                                                        >Số lượng</label>
                                                        <div class='input-group input-group-merge'>
                                                            <input
                                                                type='text'
                                                                value="{{$product->Amounts}}"
                                                                id='amount-{{$product->id}}'
                                                                class='form-control'
                                                                name='amount'
                                                            />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="d-flex mb-3 ">
                                                    <div class="form-check me-3">
                                                        @if($product->active == 1)
                                                            <input class="form-check-input" type="checkbox" checked name="active">
                                                        @else
                                                            <input class="form-check-input" type="checkbox" name="active">
                                                        @endif
                                                            <label class="form-check-label" for="defaultCheck3"> Hoạt động </label>
                                                    </div>
                                                    <div class="form-check me-3">
                                                        @if($product->ishot == 1)
                                                            <input class="form-check-input" type="checkbox" checked name="ishot">
                                                        @else
                                                            <input class="form-check-input" type="checkbox" name="ishot">
                                                        @endif
                                                        <label class="form-check-label" for="defaultCheck3"> Đang Hot </label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if($product->isnewfeed == 1)
                                                            <input class="form-check-input" type="checkbox" checked name="isnewfeed">
                                                        @else
                                                            <input class="form-check-input" type="checkbox" name="isnewfeed">
                                                        @endif
                                                        <label class="form-check-label" for="defaultCheck3"> Mới nhất </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="content-details-{{$product->id}}" role="tabpanel" aria-labelledby="content-details-{{$product->id}}-tab" tabindex="0">
                                                <div class="form-group">
                                                    <label class="mb-3" for="">Nội dung</label>
                                                    <textarea name="content" class="form-control ckeditor ckeditor-content"> {!! $product->content !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="thongsokythuat-{{$product->id}}" role="tabpanel" aria-labelledby="thongsokythuat-{{$product->id}}-tab" tabindex="0">
                                                <div class="form-group">
                                                    <label class="mb-3" for="">Thông số kỹ  thuật</label>
                                                    <textarea name="thongsokythuat" class="form-control ckeditor-thongsokythuat ckeditor">{!! $product->thongsokythuat !!}</textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type='submit' class='btn btn-success fw-semibold text-dark'>Cập nhật</button>
                                            <button type="button" class="btn btn-secondary fw-semibold" data-bs-dismiss="modal">Đóng</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="pagination mt-4 pb-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
