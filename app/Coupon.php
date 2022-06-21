<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{

    protected $table = 'coupons';
    protected $primaryKey='coupon_id';
    protected $fillable = [
        'coupon_name',
        'coupon_code',
        'coupon_time',
        'coupon_number',
        'coupon_codition',
    ];
}
