<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     <!-- * @return void
     */

    /** -->
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product_hots = Product::where('active', 1)
            ->where('ishot', 1)
            ->whereNotNull('cate_id')
            ->take(6)
            ->get();
        $product_news = Product::where('active',1)->where('isnewfeed',1)->whereNotNull('cate_id')->take(6)->get();
        $post_hots = Post::where('active',1)->where('isnewfeed',1)->take(6)->get();
        return view('home',compact('post_hots','product_hots','product_news'),[
            'title' => 'Trang chủ'
        ]);
    }

    public function search(Request $request)
    {
        $category = Category::all();
        $keyword = $request->input('keyword');

        // Tìm kiếm tài liệu theo tên
        $productsByName = Product::where('title', 'like', '%' . $keyword . '%')->get();

        // Tìm kiếm tài liệu theo danh mục
        $productsByCategory = Product::whereHas('category', function ($query) use ($keyword) {
            $query->where('title', 'like', '%' . $keyword . '%');
        })->get();

        // Kết hợp kết quả từ cả hai truy vấn
        $searchResults = $productsByName->merge($productsByCategory);

        // Phân trang kết quả
        $currentPage = Paginator::resolveCurrentPage('page') ?: 1;
        $perPage = 9;
        $currentResults = $searchResults->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $searchResults = new LengthAwarePaginator($currentResults, count($searchResults), $perPage, $currentPage, [
            'path' => Paginator::resolveCurrentPath(),
        ]);

        return view('layouts.search', compact('searchResults', 'category','keyword'), [
            'title' => 'Kết quả tìm kiếm cho từ khóa " ' . $keyword . ' "'
        ]);
    }
}
