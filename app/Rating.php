<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table = 'ratings';
    protected $primaryKey='rating_id';
    protected $fillable = [
        'product_id',
        'customer_id',
        'rating_number',
    ];
}
