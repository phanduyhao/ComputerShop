<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderByDesc('created_at')->paginate(10);
        return view('admin.order.index',compact('orders'),[
            'title' => 'Quản lý đơn hàng'
        ]);
    }
}
