<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $fillable = [
        'brand_id',
        'brand_name',
        'brand_des',
        'brand_status',
    ];
}
