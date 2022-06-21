<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $primaryKey='post_id';
    protected $fillable = [
        'post_name',
        'post_des',
        'post_content',
        'post_image',
        'post_status',
        'topic_id'
    ];
}
