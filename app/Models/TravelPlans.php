<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TravelPlans extends Model
{
    use HasFactory;
    
   protected $table = 'travel_plans';

    protected $fillable = [
        'id',
        'title',
        'slug',
        'country',
        'city',
        'flag',
        'start_date',
        'end_date',
        'status',
        'description',
        'cover_image',
        'link_page',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];
}
