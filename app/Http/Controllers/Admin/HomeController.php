<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\User;
use App\Models\Product;
use App\Models\AdminHistory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;

class HomeController extends Controller
{
    public function home(){
        $user_count = User::where("role",0)->get();
        $count_post = Post::count();
        $count_userAdmin = User::where('level',1)->count();
        $count_user= User::where('level','!=',1)->count();
        $count_cate= Category::count();
        $count_type_product= Product::count();
        $count_products= Product::Sum('Amounts');
        $count_order= Order::count();
        $tongdoanhthu = AdminHistory::Sum('amount');
        $tongdoanhthuHomNay = AdminHistory::whereDate('created_at', Carbon::today())->sum('amount');
        $tongdoanhthuThangNay = AdminHistory::whereMonth('created_at', Carbon::now()->month)
        ->whereYear('created_at', Carbon::now()->year)
        ->sum('amount');
        return view ('admin.home',compact('user_count','count_post','tongdoanhthu','tongdoanhthuHomNay','tongdoanhthuThangNay','count_userAdmin',
            'count_user','count_cate','count_type_product','count_products','count_order'),[
            'title' => 'Trang quản trị'
        ]);
    }
}
