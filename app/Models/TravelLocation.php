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
        'coordinates',
        'group_stories',
        'preview_image_journey',
        'flag_country',
    ];

    protected $casts = [
        'publish_up' => 'datetime',
        'joomla_modified' => 'datetime',
    ];

    public static function getMapPoints()
    {
        return self::query()
            ->select(
                'id',
                'title',
                'alias',
                'introtext',
                'publish_up',
                'images',
                'country',
                'city',
                'coordinates',
                'group_stories',
                'preview_image_journey',
                'flag_country',
            )
            ->get();
    }

    public static function getFilterData(?string $year = null)
    {
        return self::query()
            ->select(
                'id',
                'title',
                'alias',
                'introtext',
                'publish_up',
                'images',
                'country',
                'city',
                'coordinates',
                'group_stories',
                'preview_image_journey',
                'flag_country',
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
