<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'sliders';
    protected $primaryKey='slider_id';
    protected $fillable = [
        'slider_name',
        'slider_image',
        'slider_content',
        'slider_staus',
    ];
}
