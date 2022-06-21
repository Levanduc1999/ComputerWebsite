<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    protected $primaryKey='id_province';
    protected $fillable = [
        'name_province',
        'type',
        'id_city',
    ];
}
