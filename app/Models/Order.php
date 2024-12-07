<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    public function User()
    {
        return $this->belongsTo( User::class, 'user_id','id');
    }

    public function Address()
    {
        return $this->belongsTo( Address::class, 'address_id','id');
    }
}
