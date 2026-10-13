<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('travel_posts', function (Blueprint $table) {
             $table->string('preview_image_journey')->nullable()->after('group_stories');
             $table->string('flag_country')->nullable()->after('group_stories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('travel_posts', function (Blueprint $table) {
             $table->dropColumn(['preview_image_journey', 'flag_country']);
        });
    }
};
