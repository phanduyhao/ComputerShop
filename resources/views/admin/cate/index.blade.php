@extends('admin.main')
@section('contents')

    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Danh sách danh mục</h5>
                <div>
                    <button type="button" data-id="" class="btn btn-success text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#createCate">Thêm mới</button>
                    <button type="button"class="btn btn-danger me-2 px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModalAll">Xóa tất cả</button>
                    <div class="modal fade" id="deleteModalAll" tabindex="-1" aria-labelledby="deleteModalAllLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa tất cả danh mục không ?</h1>
                                </div>
                                <form action="{{route('deleteAllCate')}}" method="post" class="modal-footer">
                                    @csrf
                                    <button class="delete-forever btn btn-danger fw-bolder">Xóa</button>
                                    <button type="button" class="btn btn-secondary fw-bolder" data-bs-dismiss="modal">Đóng</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="createCate" tabindex="-1" aria-labelledby="createCateLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createCateLabel">Thêm mới danh mục.</h1>
                        </div>
                        <div class="card-body">
                            <div class="error">
                                @include('admin.error')
                            </div>
                            <form id="form_cate_store" class="form-create" method='POST' action='{{route('cates.store')}}'>
                                @csrf
                                <div class='mb-3'>
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
                                <div class='mb-3'>
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
                                    <label
                                        class='form-label'
                                        for='basic-default-email'
                                    >Mô tả</label>
                                    <div class='input-group input-group-merge'>
                                        <input
                                            type='text'
                                            id='desc'
                                            class='form-control'
                                            placeholder='Nhập mô tả'
                                            name='desc'
                                        />
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class='form-label'
                                           for='basic-default-email'>Danh mục cha</label>
                                    <select name="parent_id" class="form-control" id="parent_id">
                                        <option value="">Chọn danh mục cha</option>
                                        @foreach($cate_parents as $cate_parent)
                                            <option value="{{ $cate_parent->id }}">{{ $cate_parent->id }}-{{ $cate_parent->title }}</option>
                                        @endforeach
                                    </select>
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
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>ID</th>
                        <th>Tiêu dề</th>
                        <th>Mô tả</th>
                        <th>Danh mục cha</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($cates as $cate)
                        <tr data-id="{{$cate->id}}">
                            <td> {{ $loop->iteration }}</td>
                            <td>{{$cate->id}}</td>
                            <td>{{$cate->title}}</td>
                            <td>{{$cate->desc}}</td>
                            <td>
                                @if($cate->parent_id == null)
                                    0
                                @else
                                    {{$cate->parent->title}}
                                @endif
                            </td>

                            <td class="">
                                <button type="button" data-url="/admin/cates/{{$cate->id}}" data-id="{{$cate->id}}" class="btn btn-danger btnDeleteAsk me-2 px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa</button>
                                <button type="button" data-id="{{$cate->id}}" class="btn btn-edit btn-info btnEditCate text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#editCate{{$cate->id}}">Sửa</button>
                            </td>
                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="delete-forever btn btn-danger" data-id="{{ $cate->id }}">Xóa</button>
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
                @foreach($cates as $cate)
                    <div class="modal fade" id="editCate{{$cate->id}}" tabindex="-1" aria-labelledby="editCate{{$cate->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="createCateLabel">Chỉnh sửa danh mục.</h1>
                            </div>
                            <div class="card-body">
                                <div class="error">
                                    @include('admin.error')
                                </div>
                                <form class="form_cate_update form-edit" id="form_cate_update-{{$cate->id}}" data-id="{{$cate->id}}" method='post' action='{{ route('cates.update',['cate' => $cate]) }}'>
                                    @method('Patch')
                                    @csrf
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Tiêu đề</label>
                                        <input
                                            type='text'
                                            class='form-control title input-field'
                                            id='title-edit-{{$cate->id}}'
                                            placeholder='Nhập tiêu đề'
                                            name='title' data-require='Mời nhập Tiêu đề'
                                            value="{{$cate->title}}"
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-company'
                                        >Slug</label>
                                        <input
                                            type='text'
                                            class='form-control slug input-field'
                                            id='slug-edit-{{$cate->id}}'
                                            placeholder='Nhập Slug'
                                            name='slug' data-require='Mời nhập Slug'
                                            value="{{$cate->slug}}"
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-email'
                                        >Mô tả</label>
                                        <div class='input-group input-group-merge'>
                                            <input
                                                type='text'
                                                id='desc'
                                                class='form-control'
                                                placeholder='Nhập mô tả'
                                                name='desc'
                                                value="{{$cate->desc}}"
                                            />
                                        </div>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class='form-label'
                                               for='basic-default-email'>Danh mục cha</label>
                                        <select name="parent_id" class="form-control" id="parent_id">
                                            @if($cate->parent_id != null)
                                                <option value="{{ $cate->parent->id }}">{{ $cate->parent->id }}-{{ $cate->parent->title }}</option>
                                            @else
                                                <option value="">Chọn danh mục cha</option>
                                            @endif
                                            @foreach($cates as $cate)
                                                <option value="{{ $cate->id }}">{{ $cate->id }}-{{ $cate->title }}</option>
                                            @endforeach
                                        </select>
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
                    {{ $cates->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
