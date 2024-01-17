<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_name',
        'amount',
        'customer_id',
        'delivery_status',
        'payment_status',
        'currency'
    ];
}
