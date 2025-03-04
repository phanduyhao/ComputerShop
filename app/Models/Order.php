<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    const DaDatHang = 1;
    const DangGiaoHang = 2;
    const GiaoHangThanhCong = 3;
    public function User()
    {
        return $this->belongsTo( User::class, 'user_id','id');
    }
    public function Address()
    {
        return $this->belongsTo( Address::class, 'address_id','id');
    }
}
