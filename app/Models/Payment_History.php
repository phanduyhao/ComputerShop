<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment_History extends Model
{
    use HasFactory;
    protected $table = 'payment_histories';

    public function User()
    {
        return $this->belongsTo( User::class, 'user_id','id');
    }
}
