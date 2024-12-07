<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        // Lấy giá trị lọc trạng thái từ request
        $status = $request->get('status');
    
        // Kiểm tra nếu có lọc trạng thái
        $query = Order::query();
        if ($status) {
            $query->where('Status', $status);
        }
    
        // Lấy danh sách đơn hàng, sắp xếp theo thời gian và phân trang
        $orders = $query->orderByDesc('created_at')->paginate(10);
    
        return view('admin.order.index', compact('orders'), [
            'title' => 'Danh sách đơn hàng',
            'selectedStatus' => $status, // Truyền trạng thái hiện tại để hiển thị trên form
        ]);
    }
        public function updateStatus(Request $request)
    {
        $order = Order::find($request->order_id);

        if ($order) {
            $order->Status = $request->status;
            $order->save();

            return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công!']);
        }

        return response()->json(['success' => false, 'message' => 'Không tìm thấy đơn hàng!']);
    }

}
