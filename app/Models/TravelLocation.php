<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;

class TravelLocation extends Model
{
    public static function getMapPoints()
    {
        $fields =  DB::table('tnuts_fields_values as fields')
            ->join('tnuts_content', 'fields.item_id', '=', 'tnuts_content.id')
            ->select('fields.value', 'tnuts_content.title', 'tnuts_content.alias', 'tnuts_content.introtext', 'tnuts_content.publish_up', 'tnuts_content.images')
            ->where('fields.field_id', '!=', 2)
            ->get();
        return $fields;
    }

    public static function getFilterData(?string $year = null)
    {
        $fields = DB::table('tnuts_fields_values as fields')
            ->join('tnuts_content', 'fields.item_id', '=', 'tnuts_content.id')
            ->select('fields.value', 'tnuts_content.title', 'tnuts_content.alias', 'tnuts_content.introtext', 'tnuts_content.publish_up', 'tnuts_content.images')
            ->where('fields.field_id', '!=', 2)
            ->when($year, function ($query) use ($year) {
                $query->WhereLike('tnuts_content.publish_up', $year . '%');
            })
            ->get();
        return $fields;
    }
}
