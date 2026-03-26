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
        Schema::table('impact_stories', function (Blueprint $table) {
            $table->dropForeign(['section_id']);
            $table->dropColumn('section_id');
            $table->string('page')->default('home')->after('is_active');
            $table->string('image')->nullable()->after('location');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('impact_stories', function (Blueprint $table) {
            $table->dropColumn('image');
            $table->dropColumn('page');
            $table->unsignedBigInteger('section_id')->after('id');
        });
    }
};
