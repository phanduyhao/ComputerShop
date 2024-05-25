@extends('admin.main')
@section('contents')
    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Danh sách bài viết</h5>
                <div>
                    <button type="button" data-id="" class="btn btn-success text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#createPost">Thêm mới</button>
                    <button type="button"class="btn btn-danger me-2 px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModalAll">Xóa tất cả</button>
                    <div class="modal fade" id="deleteModalAll" tabindex="-1" aria-labelledby="deleteModalAllLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa tất cả bài viết không ?</h1>
                                </div>
                                <form action="{{route('deleteAllPost')}}" method="post" class="modal-footer">
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
            <div class="modal fade" id="createPost" tabindex="-1" aria-labelledby="createPostLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 1440px">
                    <div class="modal-content">
                        <div class="modal-header border-bottom">
                            <h1 class="modal-title fs-5" id="createPostLabel">Thêm mới bài viết.</h1>
                        </div>
                        <div class="nav mt-3 d-flex justify-content-center" id="nav-tab" role="tablist">
                            <button class="nav-link text-uppercase border-0 bg-white fw-bold active me-3" id="basic-info-tab" data-bs-toggle="tab" data-bs-target="#basic-info" type="button" role="tab" aria-controls="basic-info" aria-selected="true">Thông tin cơ bản</button>
                            <button class="nav-link me-3 text-uppercase border-0 bg-white fw-bold" id="content-details-tab" data-bs-toggle="tab" data-bs-target="#content-details" type="button" role="tab" aria-controls="content-details" aria-selected="false">Nội dung chi tiết</button>
                        </div>
                        <div class="card-body">
                            <div class="error">
                                @include('admin.error')
                            </div>
                            <form id="form_post_store" class="form-create" method='POST' enctype="multipart/form-data" action='{{route('posts.store')}}'>
                                @csrf
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="basic-info" role="tabpanel" aria-labelledby="basic-info-tab" tabindex="0">
                                        <div class="mb-3 d-flex flex-column image-gallery" id="image-gallery-form_post_store">
                                            <label
                                                class='form-label'
                                                for='basic-default-fullname'
                                            >Ảnh</label>
                                            <input type="file" name="thumb" class="file-input" id="file-input-form_post_store" multiple onchange="previewImages(event, 'form_post_store')">
                                            <div class="image-preview" id="image-preview-form_post_store"></div>
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
                                        <div class='mb-3'>
                                            <div class="form-group">
                                                <label class="mb-3" for="">Mô tả</label>
                                                <textarea name="desc" class="form-control ckeditor-desc ckeditor"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="content-details" role="tabpanel" aria-labelledby="content-details-tab" tabindex="0">
                                        <div class="form-group">
                                            <label class="mb-3" for="">Nội dung</label>
                                            <textarea name="content" class="form-control ckeditor-content ckeditor"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input value="Thêm mới" type='submit' class='btn btn-success fw-semibold text-dark'>
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
                        <th>Ảnh</th>
                        <th>Tiêu đề</th>
                        <th>Mô tả</th>
                        <th>Hoạt động</th>
                        <th>Đang Hot</th>
                        <th>Mới nhất</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($posts as $post)
                        <tr data-id="{{$post->id}}">
                            <td> {{ $loop->iteration }}</td>
                            <td>
                                <img width="100" src="/temp/images/post/{{$post->thumb}}" alt="{{ $post->title }}'s Avatar">
                            </td>
                            <td style="white-space: initial">{{$post->Title}}</td>
                            <td style="white-space: initial">{!! $post->description !!}</td>
                            <td>
                                @if($post->active == 1)
                                    <i class='bx bxs-circle text-success'></i>
                                @else
                                    <i class='bx bxs-circle text-danger'></i>
                                @endif
                            </td>
                            <td>
                                @if($post->ishot == 1)
                                    <i class='bx bxs-circle text-success'></i>
                                @else
                                    <i class='bx bxs-circle text-danger'></i>
                                @endif
                            </td>
                            <td>
                                @if($post->isnewfeed == 1)
                                    <i class='bx bxs-circle text-success'></i>
                                @else
                                    <i class='bx bxs-circle text-danger'></i>
                                @endif
                            </td>
                            <td class="">
                                <button type="button" data-url="/admin/posts/{{$post->id}}" data-id="{{$post->id}}" class="btn btn-danger btnDeleteAsk me-2 px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModal{{$post->id}}">Xóa</button>
                                <button type="button" data-id="{{$post->id}}" class="btn btn-edit btn-info btnEditPost text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#editPost{{$post->id}}">Sửa</button>
                            </td>
                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal{{$post->id}}" tabindex="-1" aria-labelledby="deleteModal{{$post->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModal{{$post->id}}Label">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{route('posts.destroy',['post' => $post])}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class=" btn btn-danger" type="submit">Xóa</button>

                                                <!-- <button class="delete-forever btn btn-danger" data-id="{{ $post->id }}">Xóa</button> -->
                                            </form>
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
                @foreach($posts as $post)
                    <div class="modal fade" id="editPost{{$post->id}}" tabindex="-1" aria-labelledby="editPost{{$post->id}}Label" aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 1440px">
                            <div class="modal-content">
                                <div class="modal-header border-bottom">
                                    <h1 class="modal-title fs-5" id="createPostLabel">Chỉnh sửa bài viết.</h1>
                                </div>
                                <div class="nav mt-3 d-flex justify-content-center" id="{{$post->id}}-nav-tab" role="tablist">
                                    <button class="nav-link text-uppercase border-0 bg-white fw-bold active me-3" id="basic-info-{{$post->id}}-tab" data-bs-toggle="tab" data-bs-target="#basic-info-{{$post->id}}" type="button" role="tab" aria-controls="basic-info-{{$post->id}}" aria-selected="true">Thông tin cơ bản</button>
                                    <button class="nav-link me-3 text-uppercase border-0 bg-white fw-bold" id="content-details-{{$post->id}}-tab" data-bs-toggle="tab" data-bs-target="#content-details-{{$post->id}}" type="button" role="tab" aria-controls="content-details-{{$post->id}}" aria-selected="false">Nội dung chi tiết</button>
                                </div>
                                <div class="card-body">
                                    <div class="error">
                                        @include('admin.error')
                                    </div>
                                    <form class="form_post_update form-edit" id="form_post_update-{{$post->id}}" class="form-create" method='POST' enctype="multipart/form-data" action='{{route('posts.update',['post' => $post])}}'>
                                        @method('Patch')
                                        @csrf
                                        <div class="tab-content" id="{{$post->id}}-nav-tabContent">
                                            <div class="tab-pane fade show active" id="basic-info-{{$post->id}}" role="tabpanel" aria-labelledby="basic-info-{{$post->id}}-tab" tabindex="0">
                                                <div class="mb-3 d-flex flex-column image-gallery" id="image-gallery-{{$post->id}}">
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-fullname'
                                                    >Ảnh</label>
                                                    <input type="file" name="thumb" class="file-input" id="file-input-{{$post->id}}" multiple onchange="previewImages(event, {{$post->id}})">
                                                    <div class="image-preview" id="image-preview-{{$post->id}}"></div>
                                                </div>
                                                <div class='mb-3 w-100 me-3'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-fullname'
                                                    >Tiêu đề</label>
                                                    <input
                                                        type='text'
                                                        class='form-control title input-field '
                                                        id='title-edit-{{$post->id}}'
                                                        placeholder='Nhập tiêu đề'
                                                        value="{{$post->Title}}"
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
                                                        id='slug-edit-{{$post->id}}'
                                                        value="{{$post->slug}}"
                                                        placeholder='Nhập Slug'
                                                        name='slug' data-require='Mời nhập Slug'
                                                    />
                                                </div>
                                                <div class="d-flex mb-3 ">
                                                    <div class="form-check me-3">
                                                        @if($post->active == 1)
                                                            <input class="form-check-input" type="checkbox" checked name="active">
                                                        @else
                                                            <input class="form-check-input" type="checkbox" name="active">
                                                        @endif
                                                        <label class="form-check-label" for="defaultCheck3"> Hoạt động </label>
                                                    </div>
                                                    <div class="form-check me-3">
                                                        @if($post->ishot == 1)
                                                            <input class="form-check-input" type="checkbox" checked name="ishot">
                                                        @else
                                                            <input class="form-check-input" type="checkbox" name="ishot">
                                                        @endif
                                                        <label class="form-check-label" for="defaultCheck3"> Đang Hot </label>
                                                    </div>
                                                    <div class="form-check">
                                                        @if($post->isnewfeed == 1)
                                                            <input class="form-check-input" type="checkbox" checked name="isnewfeed">
                                                        @else
                                                            <input class="form-check-input" type="checkbox" name="isnewfeed">
                                                        @endif
                                                        <label class="form-check-label" for="defaultCheck3"> Mới nhất </label>
                                                    </div>
                                                </div>
                                                <div class='mb-3'>
                                                    <div class="form-group">
                                                        <label class="mb-3" for="">Mô tả</label>
                                                        <textarea name="desc" class="form-control ckeditor-desc ckeditor"> {!! $post->description !!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="content-details-{{$post->id}}" role="tabpanel" aria-labelledby="content-details-{{$post->id}}-tab" tabindex="0">
                                                <div class="form-group">
                                                    <label class="mb-3" for="">Nội dung</label>
                                                    <textarea name="content" class="form-control ckeditor ckeditor-content"> {!! $post->content !!}</textarea>
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
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
