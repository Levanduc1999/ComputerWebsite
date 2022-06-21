<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'id',
        'customer_id',
        'shipping_id',
        'payment_id',
        'order_total',
        'order_status',
    ];
}
