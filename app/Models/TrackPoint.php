<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackPoint extends Model
{
    protected $fillable = [
        'device_id',
        'lat',
        'lon'
    ];
}
