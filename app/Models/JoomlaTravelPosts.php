<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JoomlaTravelPosts extends Model
{
    protected $connection = 'notes_db';
    protected $table = 'tnuts_content';
    public $timestamps = false;
}
