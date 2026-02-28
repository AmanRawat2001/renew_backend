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
        Schema::table('feature_cards', function (Blueprint $table) {
            $table->string('page')->default('home')->after('is_active')->comment('Page where mission slide appears: home, empowering-lives, etc.');
            $table->index('page');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feature_cards', function (Blueprint $table) {
            $table->dropIndex(['page']);
            $table->dropColumn('page');
            //
        });
    }
};
