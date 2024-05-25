@extends('admin.main')
@section('contents')
    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Danh sách địa chỉ</h5>
            </div>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>SĐT</th>
                        <th>Tên</th>
                        <th>Quốc gia</th>
                        <th>Tỉnh / Thành phố</th>
                        <th>Huyện / Quận</th>
                        <th>Xã / Phường</th>
                        <th>Thôn / Xóm</th>
                        <th>Tài khoản</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($addresses as $address)
                        <tr data-id="{{$address->id}}">
                            <td>{{$address->id}}</td>
                            <td>{{$address->sdt}}</td>
                            <td>{{$address->name}}</td>
                            <td>{{$address->Country}}</td>
                            <td>{{$address->province}}</td>
                            <td>{{$address->district}}</td>
                            <td>{{$address->wards}}</td>
                            <td>{{$address->address}}</td>
                            <td>{{$address->User->name}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination mt-4 pb-4">
                    {{ $addresses->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
