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
        Schema::create('travel_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('joomla_id')->unique();
            $table->string('title');
            $table->string('alias')->nullable();
            $table->text('introtext')->nullable();
            $table->text('value')->nullable();
            $table->text('images')->nullable();
            $table->dateTime('publish_up')->nullable();
            $table->dateTime('joomla_modified')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_posts');
    }
};
