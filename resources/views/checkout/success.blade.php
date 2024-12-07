@extends('layouts.layout')

@section('content')
<div class="container mt-5" style="padding: 200px 0">
    <div class="card shadow-lg p-4">
        <h2 class="text-success text-center">🎉 Đặt hàng thành công! 🎉</h2>
        <p class="text-center">Cảm ơn bạn đã mua hàng! Dưới đây là thông tin đơn hàng của bạn:</p>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">🛒 Đơn hàng #{{ $order->id }}</h5>
                <p><strong>Trạng thái:</strong> <span class="badge bg-warning" style="font-size: 16px">Đã đặt hàng</span></p>
                <p><strong>Tổng tiền:</strong> {{ number_format($order->total, 0, ',', '.') }} VND</p>
                <p><strong>Thời gian thanh toán:</strong> {{ $order->created_at->format('d/m/Y H:i:s') }}</p>

            </div>
        </div>

        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">📦 Sản phẩm đã mua</h5>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                            <th>Tổng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $stt = 1; @endphp
                        @foreach(json_decode($order->products, true) as $item)
                        <tr>
                            <td>{{ $stt++ }}</td>
                            <td>{{ $item['title'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['price'], 0, ',', '.') }} VND</td>
                            <td>{{ number_format($item['subtotal'], 0, ',', '.') }} VND</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- 📍 Thêm phần hiển thị địa chỉ giao hàng -->
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">📍 Địa chỉ giao hàng</h5>
                <p><strong>Người nhận:</strong> {{ $order->Address->name ?? 'Không có thông tin' }}</p>
                <p><strong>Số điện thoại:</strong> {{ $order->Address->sdt ?? 'Không có thông tin' }}</p>
                <p><strong>Địa chỉ:</strong> {{ $order->Address->address ?? 'Không có thông tin' }}</p>
                <p><strong>Phường/Xã:</strong> {{ $order->Address->wards ?? 'Không có thông tin' }}</p>
                <p><strong>Quận/Huyện:</strong> {{ $order->Address->district ?? 'Không có thông tin' }}</p>
                <p><strong>Tỉnh/Thành phố:</strong> {{ $order->Address->province ?? 'Không có thông tin' }}</p>
                <p><strong>Quốc gia:</strong> {{ $order->Address->Country ?? 'Không có thông tin' }}</p>
            </div>
        </div>

        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="btn btn-primary">Quay lại trang chủ</a>
        </div>
    </div>
</div>
@endsection
