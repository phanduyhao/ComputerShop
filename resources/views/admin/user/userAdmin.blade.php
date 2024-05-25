@extends('admin.main')
@section('contents')
    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Danh sách tải khoản quản trị </h5>
                <button type="button" data-id="" class="btn btn-success text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#createUser">Thêm mới</button>
            </div>

            <div class="modal fade" id="createUser" tabindex="-1" aria-labelledby="createUserLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="createUserLabel">Thêm mới tài khoản quản trị.</h1>
                        </div>
                        <div class="card-body">
                            <div class="error">
                                @include('admin.error')
                            </div>
                            <form id="form_userAdmin_store" class="form-create" method='POST' action='{{route('user.store')}}' enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 d-flex flex-column image-gallery" id="image-gallery-form_userAdmin_store">
                                    <label
                                        class='form-label'
                                        for='basic-default-fullname'
                                    >Ảnh</label>
                                    <input type="file" name="avatar" class="file-input" id="file-input-form_userAdmin_store" multiple onchange="previewImages(event, 'form_userAdmin_store')">
                                    <div class="image-preview" id="image-preview-form_userAdmin_store"></div>
                                </div>
                                <div class='mb-3'>
                                    <label
                                        class='form-label'
                                        for='basic-default-fullname'
                                    >Tên</label>
                                    <input
                                        type='text'
                                        class='form-control input-field'
                                        id='name'
                                        placeholder='Nhập tên'
                                        name='name' data-require='Mời nhập tên'
                                    />
                                </div>
                                <div class='mb-3'>
                                    <label
                                        class='form-label'
                                        for='basic-default-company'
                                    >Email</label>
                                    <input
                                        type='email'
                                        class='form-control input-field'
                                        id='email'
                                        placeholder='Nhập Email'
                                        name='email' data-require='Mời nhập email'
                                    />
                                </div>
                                <div class='mb-3'>
                                    <label
                                        class='form-label'
                                        for='basic-default-email'
                                    >Mật khẩu</label>
                                        <input
                                            type='password'
                                            id='password'
                                            class='form-control input-field'
                                            placeholder='Nhập mật khẩu'
                                            name='password' data-require='Mời nhập mật khẩu'
                                        />

                                </div>
                                <div class='mb-3 d-flex justify-content-start'>
                                    <div class='mb-3 me-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-email'
                                        >Cấp độ</label>
                                            <input
                                                type='number'
                                                id='level'
                                                class='form-control'
                                                min='0'
                                                name='level'
                                            />
                                    </div>
                                    <div class='mb-3 me-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-email'
                                        >Quyền</label>
                                            <input
                                                type='text'
                                                id='role'
                                                class='form-control input-field'
                                                min='0'
                                                name='role' data-require='Mời nhập quyền'
                                            />
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

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>STT</th>
                        <th>ẢNh</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Quyền</th>
                        <th>Cấp độ</th>
                        <th>Thời gian tạo</th>
                        <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($users as $user)
                        <tr data-id="{{$user->id}}">
                            <td> {{ $loop->iteration }}</td>
                            <td>
                                <img width="100" src="/temp/images/avatars/{{$user->avatar}}" alt="{{ $user->name }}'s Avatar">

                            </td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->role}}</td>
                            <td>{{$user->level}}</td>
                            <td>{{$user->created_at}}</td>
                            <td class="">
                                    <button type="button" data-url="/admin/users/{{$user->id}}" data-id="{{$user->id}}" class="btn btn-danger btnDeleteAsk px-2 me-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa</button>
                                    <button type="button" data-id="{{$user->id}}" class="btn btn-edit btn-info btnEditUser text-dark px-2 py-1 fw-bolder" data-bs-toggle="modal" data-bs-target="#editUser{{$user->id}}">Sửa</button>
                            </td>

                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h1>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="delete-forever btn btn-danger" data-id="{{ $user->id }}">Xóa</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>

                    @endforeach
                    </tbody>
                </table>
                <!-- Modal Edit -->
                @foreach($users as $user)
                <div class="modal fade" id="editUser{{$user->id}}" tabindex="-1" aria-labelledby="editUser{{$user->id}}Label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="createUserLabel">Chỉnh sửa tài khoản.</h1>
                            </div>
                            <div class="card-body">
                                <form method='post' action='{{ route('user.update',['user' => $user]) }}' enctype="multipart/form-data" class="editUserForm form-edit" id="form_userAdmin_update-{{$user->id}}">
                                    @method('PATCH')
                                    @csrf
                                    <div class="mb-3 d-flex flex-column image-gallery" id="image-gallery-{{$user->id}}">
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Ảnh</label>
                                        <input type="file" name="avatar" class="file-input" id="file-input-{{$user->id}}" multiple onchange="previewImages(event,{{$user->id}})">
                                        <div class="image-preview" id="image-preview-{{$user->id}}"></div>
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-fullname'
                                        >Tên</label>
                                        <input
                                            type='text'
                                            class='form-control input-field'
                                            id='name-{{$user->id}}'
                                            value="{{$user->name}}"
                                            placeholder='Nhập tên'
                                            name='name' data-require='Mời nhập tên'
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-company'
                                        >Email</label>
                                        <input
                                            type='email'
                                            class='form-control input-field'
                                            id='email-{{$user->id}}'
                                            value="{{$user->email}}"
                                            placeholder='Nhập Email'
                                            name='email' data-require='Mời nhập email'
                                        />
                                    </div>
                                    <div class='mb-3'>
                                        <label
                                            class='form-label'
                                            for='basic-default-email'
                                        >Mật khẩu</label>
                                        <input
                                            type='password'
                                            id='password-{{$user->id}}'
                                            class='form-control'
                                            value=""
                                            placeholder='Nhập mật khẩu'
                                            name='password'
                                        />

                                    </div>
                                    <div class='mb-3 d-flex justify-content-start'>
                                        <div class='mb-3 me-3'>
                                            <label
                                                class='form-label'
                                                for='basic-default-email'
                                            >Cấp độ</label>
                                            <input
                                                type='number'
                                                id='level-{{$user->id}}'
                                                class='form-control'
                                                value="{{$user->level}}"
                                                min='0'
                                                name='level'
                                            />
                                        </div>
                                        <div class='mb-3 me-3'>
                                            <label
                                                class='form-label'
                                                for='basic-default-email'
                                            >Quyền</label>
                                            <input
                                                type='text'
                                                id='role-{{$user->id}}'
                                                value="{{$user->role}}"
                                                class='form-control input-field'
                                                min='0'
                                                name='role' data-require='Mời nhập quyền'
                                            />
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
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
