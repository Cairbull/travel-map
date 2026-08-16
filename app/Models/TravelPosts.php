<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelPosts extends Model
{
    protected $fillable = [
        'joomla_id',
        'title',
        'alias',
        'introtext',
         'publish_up',
        'images',
        'country',
        'city',
        'coordinates',
        'joomla_modified',
    ];

    protected $casts = [
        'publish_up' => 'datetime',
        'joomla_modified' => 'datetime',
    ];
}
