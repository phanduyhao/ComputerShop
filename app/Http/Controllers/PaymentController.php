<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use App\Models\AdminHistory;
use Illuminate\Http\Request;
use App\Models\Payment_History;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function Payment(Request $request)
    {
        Log::info($request->all());
        $userId = Auth::id();
        
        // Kiểm tra giỏ hàng có sản phẩm không
        $cartItems = Cart::where('user_id', $userId)->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.view')->with('error', 'Giỏ hàng của bạn đang trống!');
        }
        if (!$request->sdt || !$request->name || !$request->address) {
            return redirect()->back()->with('error', 'Vui lòng nhập đầy đủ địa chỉ!');
        }
        // Tạo đơn hàng trước khi chuyển sang VNPay
        $order = new Order();
        $existingRecord = Address::where('sdt', $request->sdt)
            ->where('name', $request->name)
            ->where('Country', $request->Country)
            ->where('province', $request->province)
            ->where('district', $request->district)
            ->where('wards', $request->wards)
            ->where('address', $request->address)
            ->first();
        if(!$existingRecord){
            $address = new Address;
            $address->sdt = $request->sdt;
            $address->name = $request->name;
            $address->user_id = Auth::id();
            $address->Country = $request->Country;
            $address->province = $request->province;
            $address->district = $request->district;
            $address->wards = $request->wards;
            $address->address = $request->address;
            $address->save();
            $order->address_id = $address->id;

        }else{
            $order->address_id = $existingRecord->id;
        }

        $order->user_id = $userId;
        $order->total = $request->amount_money;
        $order->status = 0; // 0 = chờ thanh toán
        $order->save();

        // Lưu thông tin sản phẩm vào đơn hàng
        $productsData = [];
        foreach ($cartItems as $cartItem) {
            $productsData[] = [
                'title' => $cartItem->nameProduct,
                'slug' => $cartItem->Product->slug,
                'price' => $cartItem->price,
                'quantity' => $cartItem->quanity,
                'subtotal' => $cartItem->subtotal,
                'sizes' => $cartItem->sizes,
                'colors' => $cartItem->colors,
            ];
        }
        $order->products = json_encode($productsData);
        $order->save();

        // Lưu mã đơn hàng vào Payment_History
        $checkout = new Payment_History();
        $checkout->order_code = $order->id;
        $checkout->user_id = $userId;
        $checkout->amount_money = $request->amount_money;
        $checkout->save();

        // Chuyển hướng đến VNPay
        error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = route('checkout.complete', ['code' => $checkout->order_code, 'amount_money' => $request->amount_money]);
        $vnp_TmnCode = "17AY5EOG";
        $vnp_HashSecret = "1GJ1Z7RJW93EQMSV7NANEDLF8TXUBSKX";
        $code_cart = rand(00, 9999);
        $vnp_TxnRef = $code_cart;
        $vnp_OrderInfo = "Thanh toán đơn hàng test";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount =  $request->amount_money * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = $request->bank_code;
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $checkout->save();
        header('Location: ' . $vnp_Url);
        die();
    }

    public function complete(Request $request, $code)
    {
        $order = Order::find($code);
        if (!$order) {
            return redirect()->route('home')->with('error', 'Không tìm thấy đơn hàng!');
        }

        if ($request->query('vnp_ResponseCode') == '00') {
            // Thanh toán thành công
            $order->status = 1; // 1 = đã thanh toán
            $order->save();

            // Trừ số lượng sản phẩm trong kho
            $cartItems = json_decode($order->products, true);
            foreach ($cartItems as $item) {
                $product = Product::where('slug', $item['slug'])->first();
                if ($product) {
                    $product->Amounts = max(0, $product->Amounts - $item['quantity']);
                    $product->save();
                }
            }

            // Lưu lịch sử giao dịch của admin
            $adminHistory = new AdminHistory();
            $adminHistory->amount = $order->total;
            $adminHistory->order_id = $order->id;
            $adminHistory->user_id = Auth::id();
            $adminHistory->save();

            // Xóa giỏ hàng sau khi thanh toán thành công
            Cart::where('user_id', Auth::id())->delete();

            return view('checkout.vnpay_complete', compact("order"), [
                'title' => 'Thanh toán thành công!'
            ]);
        } else {
            // Nếu thanh toán thất bại, hủy đơn hàng
            $order->delete();
            return redirect()->route('cart.view')->with('error', 'Thanh toán không thành công, vui lòng thử lại.');
        }
    }


}
