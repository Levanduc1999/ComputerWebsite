<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
     protected $table = 'wards';
    protected $primaryKey='id_ward';
    protected $fillable = [
        'name_ward',
        'type',
        'id_province',
    ];
}
