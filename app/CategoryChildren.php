<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryChildren extends Model
{
    protected $table = 'category_childrens';
    protected $primaryKey='category_childrens_id';
    protected $fillable = [
        'category_childrens_name',
        'category_childrens_des',
        'category_childrens_status',
        'category_id'
    ];
}
