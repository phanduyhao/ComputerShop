<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Category::whereNull('parent_id')->with('children')->get();
        return view('cate.index', compact('menus'));
    }
}
