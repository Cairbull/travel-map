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
        Schema::create('travel_plans', function (Blueprint $table) {
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('country')->nullable();
            $table->text('city')->nullable();
            $table->text('flag')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->text('status')->nullable();
            $table->text('description')->nullable();
            $table->text('cover_image')->nullable();
            $table->text('link_page')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('travel_plans');
    }
};
