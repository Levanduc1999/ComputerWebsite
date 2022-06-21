<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table = 'shippings';
    protected $fillable = [
        'shipping_id',
        'shipping_name',
        'shipping_adress',
        'shipping_email',
        'shipping_phone',
        'shipping_note'
    ];
}
