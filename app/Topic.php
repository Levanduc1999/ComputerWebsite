<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';
    protected $primaryKey='topic_id';
    protected $fillable = [
        'topic_name',
        'topic_des',
        'topic_status',
    ];
}
