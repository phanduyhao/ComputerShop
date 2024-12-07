<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Address;
use App\Models\Product;
use App\Models\AdminHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

session_start();
class MainCheckoutController extends Controller
{
    public function ShowToCheckout(){
        $addresses = Address::where('user_id',Auth::user()->id)->get();
        return view('checkout.checkout',compact('addresses'),[
            'title' => 'Mua hàng'
        ]);
    }

//    Thanh toán
    public function checkout(Request $request){
        $this->validate($request,[
            'sdt' => 'required',
            'name' => 'required',
            'Country' => 'required',
            'district' => 'required',
            'province' => 'required',
            'wards' => 'required',
            'address' => 'required',
        ],[
            'sdt.required' => 'Vui lòng nhập số điện thoại !',
            'name.required' => 'Vui lòng nhập tên !',
            'Country.required' => 'Vui lòng điền Quốc gia !',
            'province.required' => 'Vui lòng nhập Tỉnh / Thành phố !',
            'wards.required' => 'Vui lòng nhập Xã / Phường !',
            'district.required' => 'Vui lòng nhập Quận / Huyện !',
            'address.required' => 'Vui lòng nhập Số đường / số nhà !',
        ]);
        $order = new Order;
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

        $cartItems = Cart::all();
        // Lưu dữ liệu vào bảng Orders
        $order->user_id = Auth::id(); // Điền user_id tương ứng từ bảng Cart
        $productsData = [];
        foreach ($cartItems as $cartItem) {
            if($cartItem->user_id == Auth::id()){
                $productsData[] = [
                    'title' => $cartItem->nameProduct,
                    'slug' => $cartItem->Product->slug,
                    'price' => $cartItem->price,
                    'quantity' => $cartItem->quanity,
                    'subtotal' => $cartItem->subtotal,
                    'sizes' => $cartItem->sizes,
                    'colors' => $cartItem->colors,
                    // Thêm các trường khác nếu cần thiết
                ];

                // Cập nhật số lượng sản phẩm sau khi mua
                $product = Product::find($cartItem->product_id);
                if($product){
                    $newQuantity = $product->Amounts - $cartItem->quanity;
                    $product->Amounts = $newQuantity >=0 ? $newQuantity :0;
                    $product->save();
                }
            }
        }
        $order->products = json_encode($productsData);
        $order->total = $request->total2;
        $order->status = 1;
        $order->save();
        $admin_history = new AdminHistory;
        $admin_history->amount = $request->total2;
        $admin_history->order_id = $order->id;
        $admin_history->user_id = Auth::user()->id;
        $admin_history->save();
        Cart::truncate();
        return redirect()->route('checkout.success');
    }

//    Thanh toán thành công - xuất hóa đơn
    public function showOrder(){
        $order = Order::latest('id')->first();
        $time = $order->updated_at;
        return view("checkout.success",compact('order'),[
            'title' => 'Thanh toán thành công!'
        ]);
    }
}
