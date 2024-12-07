@extends('admin.main')
@section('contents')
    <div class="container-fluid flex-grow-1 container-p-y">
        <h3 class="fw-bold text-primary py-3 mb-4">{{$title}}</h3>
        <div class="card">
            <div class="d-flex p-4 justify-content-between">
                <h5 class=" fw-bold">Danh sách đơn hàng</h5>
                <div class="d-flex align-items-center">
                    <h5 class="me-3">Lọc:</h5>
                    <form action="{{ route('orders.index') }}" method="get">
                        <select name="status" class="form-control" id="status" onchange="this.form.submit()">
                            <option value="">Tất cả trạng thái</option>
                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Đã đặt hàng</option>
                            <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>Đang giao hàng</option>
                            <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>Giao hàng thành công</option>
                        </select>
                    </form>
                </div>
                
            </div>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr class="text-nowrap">
                        <th>ID</th>
                        <th>Tài khoản</th>
                        <th>Sản phẩm</th>
                        <th>Tổng tiền</th>
                        <th>Địa chỉ</th>
                        <th>Thời gian</th>
                        <th>Trạng thái</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0 text-wrap">
                    @foreach($orders as $order)
                        <tr data-id="{{$order->id}}">
                            <td>{{$order->id}}</td>
                            <td>{{$order->User->name}}</td>
                            @php
                                $decodedProducts = json_decode($order->products, true);
                            @endphp

                            <td>
                                <ol>
                                    @foreach($decodedProducts as $product)
                                        <li class="mt-2">
                                            <strong>Sản phẩm:</strong> <a href="{{ route('products.details', ['slug' =>$product['slug']]) }}">{{ $product['title'] }}</a><br>
                                                <strong>Giá:</strong> {{ number_format($product['price']) }} VNĐ<br>
                                                <strong>Số lượng:</strong> {{ $product['quantity'] }}<br>
                                            <strong>Tổng giá:</strong> {{ number_format($product['subtotal']) }} VNĐ<br>
                                        </li>
                                    @endforeach
                                </ol>
                            </td>
                            <td>{{$order->total}}</td>
                            <td class="text-wrap">
                                {{ $order->Address?->address ?? 'Không có địa chỉ' }},
                                {{ $order->Address?->wards ?? '' }},
                                {{ $order->Address?->district ?? '' }},
                                {{ $order->Address?->province ?? '' }},
                                {{ $order->Address?->Country ?? '' }}
                            </td>

                            <td>{{$order->updated_at}}</td>
                            <td>
                                @if($order->Status === 1)
                                    <select name="status" class="form-control bg-info text-dark fw-bold" id="status">
                                        <option selected value="1">Đã đặt hàng</option>
                                        <option value="2">Đang giao hàng</option>
                                        <option value="3">Giao hàng thành công</option>
                                    </select>
                                @elseif($order->Status === 2)
                                    <select name="status" class="form-control bg-warning text-dark fw-bold" id="status">
                                        <option selected value="2">Đang giao hàng</option>
                                        <option value="1">Đã đặt hàng</option>
                                        <option value="3">Giao hàng thành công</option>
                                    </select>
                                @else
                                    <select name="status" class="form-control bg-success  text-dark fw-bold" id="status">
                                        <option selected value="3">Giao hàng thành công</option>
                                        <option value="1">Đã đặt hàng</option>
                                        <option value="2">Đang giao hàng</option>
                                    </select>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pagination mt-4 pb-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
document.addEventListener("DOMContentLoaded", function () {
    const statusSelects = document.querySelectorAll('select[name="status"]');
    
    statusSelects.forEach(function (select) {
        select.addEventListener('change', function () {
            const row = select.closest('tr'); // Lấy dòng chứa đơn hàng
            const orderId = row.getAttribute('data-id'); // Lấy ID của đơn hàng
            const newStatus = select.value; // Lấy trạng thái mới được chọn

            // Tạo một request HTTP bằng Fetch API
            fetch("{{ route('orders.updateStatus') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}" // CSRF token
                },
                body: JSON.stringify({
                    order_id: orderId,
                    status: newStatus
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.reload();

                } else {
                    alert(data.message); // Hiển thị thông báo lỗi
                }
            })
            .catch(error => {
                alert('Có lỗi xảy ra khi cập nhật trạng thái!');
                console.error('Error:', error);
            });
        });
    });
});

</script>