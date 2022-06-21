<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey='product_id';
    protected $fillable = [
        'product_name',
        'category_childrens_id',
        'brand_id',
        'product_des',
        'product_content',
        'product_price',
        'product_image',
        'product_status',
    ];
}
