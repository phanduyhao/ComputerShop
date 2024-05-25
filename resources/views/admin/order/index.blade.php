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
                        <th>Tài khoản</th>
                        <th>Sản phẩm</th>
                        <th>Tổng tiền</th>
                        <th>Thời gian</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
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
                                            <strong>Sản phẩm:</strong> {{ $product['title'] }}<br>
                                            <strong>Link:</strong> <a href="{{ route('products.details', ['slug' =>$product['slug']]) }}">{{$product['slug']}}</a><br>
                                            <strong>Giá:</strong> {{ number_format($product['price']) }} VNĐ<br>
                                            <strong>Số lượng:</strong> {{ $product['quantity'] }}<br>
                                            <strong>Tổng giá:</strong> {{ number_format($product['subtotal']) }} VNĐ<br>
                                        </li>
                                    @endforeach
                                </ol>
                            </td>
                            <td>{{$order->total}}</td>
                            <td>{{$order->updated_at}}</td>

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
