<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $table = 'category_products';
    protected $fillable = [
        'category_id',
        'category_name',
        'category_des',
        'category_status',
    ];
    
}
