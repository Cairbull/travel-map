<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TravelLocation extends Model
{
    protected $table = 'travel_posts';

    protected $fillable = [
        'joomla_id',
        'value',
        'title',
        'alias',
        'introtext',
        'publish_up',
        'images',
        'joomla_modified',
        'country',
        'city',
        'coordinates'
    ];

    protected $casts = [
        'publish_up' => 'datetime',
        'joomla_modified' => 'datetime',
    ];

    public static function getMapPoints()
    {
        return self::query()
            ->select(
                'title',
                'alias',
                'introtext',
                'publish_up',
                'images',
                'country',
                'city',
                'coordinates'
            )
            ->get();
    }

    public static function getFilterData(?string $year = null)
    {
        return self::query()
            ->select(
                'title',
                'alias',
                'introtext',
                'publish_up',
                'images',
                'country',
                'city',
                'coordinates'
            )
            ->when($year, function ($query) use ($year) {
                $query->where(
                    'publish_up',
                    'LIKE',
                    $year . '%'
                );
            })
            ->get();
    }
}
