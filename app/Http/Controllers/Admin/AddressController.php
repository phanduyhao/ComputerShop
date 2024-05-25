<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::paginate(10);
        return view('admin.address.index',compact('addresses'),[
            'title' => 'Quản lý địa chỉ'
        ]);
    }
}
