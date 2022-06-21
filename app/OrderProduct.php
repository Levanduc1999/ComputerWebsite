<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    protected $table = 'order_products';
    protected $primaryKey='id';
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_price',
        'product_order_quantity',
        'product_sale',
    ];
}
