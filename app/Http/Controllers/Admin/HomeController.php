<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $user_count = User::where("role",0)->get();

        $product_count = Product::all();
        $post = Post::all();
        return view ('admin.home',compact('user_count','product_count','post'),[
            'title' => 'Trang quản trị'
        ]);
    }
}
