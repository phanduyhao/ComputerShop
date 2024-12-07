<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class MainProductController extends Controller
{
    public function shop(Request $request)
    {
        // Lấy danh sách sản phẩm theo cate_id của danh mục
        $query = Product::where('active', 1);
        $nameProduct = $request->nameProduct;

            // Kiểm tra xem có yêu cầu tìm kiếm không
        if ($request->has('nameProduct') && $nameProduct != '') {
            $query->where('Title', 'LIKE', '%' . $nameProduct . '%'); // Tìm kiếm theo tên sản phẩm
        }
        // Kiểm tra xem có yêu cầu sắp xếp theo giá không
        if ($request->has('sort')) {
            if ($request->sort == 1) {
                $query->orderBy('id', 'asc'); // Thấp đến cao
            } elseif ($request->sort == 2) {
                $query->orderBy('id', 'desc'); // Cao đến thấp
            }
        }
        $pages = 6;
        // Phân trang sản phẩm
        $products = $query->paginate($pages);
        
        // Lấy danh sách các danh mục con không có cha
        $category_no_parent_ids = Category::where('parent_id', '!=', null)->get();
        return view('product.all_product', compact( 'products', 'category_no_parent_ids','pages','nameProduct'),[
            'title'=>'Cửa hàng'
        ]);
    }

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
