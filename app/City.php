<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'cities';
    protected $primaryKey='id_city';
    protected $fillable = [
        'name_city',
        'type',
    ];
}
