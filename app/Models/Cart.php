<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table ='carts';

    public function Product()
    {
        return $this->belongsTo(Product::class, 'product_id','id');
    }
    public function Address()
    {
        return $this->belongsTo(Address::class, 'address_id','id');
    }
    public function User()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
