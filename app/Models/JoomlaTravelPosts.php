<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JoomlaTravelPosts extends Model
{
    protected $connection = 'notes_db';
    protected $table = 'tnuts_content';
    public $timestamps = false;

    private const FIELD_COUNTRY = 3;
    private const FIELD_CITY = 4;
    private const FIELD_COORDINATES = 5;
    private const FIELD_GROUP_STORIES = 6;
    private const FIELD_PREVIEW_IMAGE_JOURNEY = 7;
    private const FIELD_FLAG_COUNTRY = 8;

    // Переработка SQL запроса для прямого запроса к таблице Laravel (раньше обращался к Joomla)
    public static function getForSync()
    {
        return DB::connection('notes_db')
            ->table('tnuts_content as content')
            ->join(
                'tnuts_fields_values as fields',
                'fields.item_id',
                '=',
                'content.id'
            )
            ->select(
                'content.id',
                'content.title',
                'content.alias',
                'content.introtext',
                'content.publish_up',
                'content.images',
                'content.modified'
            )
            ->selectRaw("MAX(CASE WHEN fields.field_id = ? THEN fields.value END) as country", [self::FIELD_COUNTRY])
            ->selectRaw("MAX(CASE WHEN fields.field_id = ? THEN fields.value END) as city", [self::FIELD_CITY])
            ->selectRaw("MAX(CASE WHEN fields.field_id = ? THEN fields.value END) as coordinates", [self::FIELD_COORDINATES])
            ->selectRaw("MAX(CASE WHEN fields.field_id = ? THEN fields.value END) as group_stories", [self::FIELD_GROUP_STORIES])
            ->selectRaw("MAX(CASE WHEN fields.field_id = ? THEN fields.value END) as preview_image_journey", [self::FIELD_PREVIEW_IMAGE_JOURNEY])
            ->selectRaw("MAX(CASE WHEN fields.field_id = ? THEN fields.value END) as flag_country", [self::FIELD_FLAG_COUNTRY])
            ->whereIn('fields.field_id', [
                self::FIELD_COUNTRY,
                self::FIELD_CITY,
                self::FIELD_COORDINATES,
                self::FIELD_GROUP_STORIES,
                self::FIELD_PREVIEW_IMAGE_JOURNEY,
                self::FIELD_FLAG_COUNTRY,
            ])
            ->groupBy('content.id', 'content.title', 'content.alias', 'content.introtext', 'content.publish_up', 'content.images', 'content.modified')
            ->get();
    }
}
