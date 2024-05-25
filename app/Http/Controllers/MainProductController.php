<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainProductController extends Controller
{

    public function ShowProduct($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)->firstOrFail();
        $products = Product::where('cate_id', $category->id)->paginate(6);

        return view('product.list_product', compact('category', 'products'),[
            'title'=>'Sản phẩm '. $category->title
        ]);
    }

    public function ProductDetail($slug){
        $product = Product::where('slug', $slug)->first();
        $title = $product->Title;
        return view('product.details',compact('product'),[
            'title' => $title
        ]);
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $userId = $request->input('user_id');
        $thumb = $request->input('thumb');
        $name = $request->input('name');
        $price = $request->input('price');
        $quantity = $request->input('quantity');
        $subtotal = $request->input('subtotal');
        // Kiểm tra xem đã có bản ghi có user_id và document_id tương ứng chưa
        $existingRecord = Cart::where('product_id', $productId)
            ->where('user_id', $userId)
            ->first();
        if (!$existingRecord) {
            $cart = new Cart;
            $cart->product_id = $productId;
            $cart->thumb = $thumb;
            $cart->user_id = $userId;
            $cart->price = $price;
            $cart->nameProduct = $name;
            $cart->quanity = $quantity;
            $cart->subtotal =$subtotal;
            $cart->save();
        }else{
            $existingRecord->quanity =  $existingRecord->quanity + $quantity;
            $existingRecord->subtotal =  $existingRecord->subtotal * $existingRecord->quanity;
            $existingRecord->save();
        }
        return response()->json(['success' => true, 'message' => 'Thêm giỏ hàng thành công!']);
    }
}
