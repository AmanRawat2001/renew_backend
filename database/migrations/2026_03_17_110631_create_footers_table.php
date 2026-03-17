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
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->comment('Unique identifier for footer item');
            $table->text('value')->nullable()->comment('Content or value for the footer item');
            $table->string('image')->nullable()->comment('Image URL for footer');
            $table->integer('sequence')->default(0)->comment('Order of display');
            $table->boolean('is_active')->default(true)->comment('Enable/disable footer item');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
