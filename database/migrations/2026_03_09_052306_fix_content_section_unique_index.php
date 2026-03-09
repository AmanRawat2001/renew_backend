<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('content_sections', function (Blueprint $table) {
            $table->dropUnique(['section_key']);
            $table->unique(['section_key', 'page']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('content_sections', function (Blueprint $table) {
            $table->dropUnique(['section_key', 'page']);
            $table->unique('section_key');
        });
    }
};
