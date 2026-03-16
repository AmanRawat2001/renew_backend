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
        Schema::create('impact_story_sections', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('main_image');
            $table->integer('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->string('page')->default('home');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('impact_story_sections');
    }
};
