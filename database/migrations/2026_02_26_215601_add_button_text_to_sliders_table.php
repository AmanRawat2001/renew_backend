<?php

use App\Enums\SliderPage;
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
        Schema::table('sliders', function (Blueprint $table) {
            $table->string('button_text')->nullable()->after('sub_title')->comment('CTA button text');
            $table->string('page')->default('home')->after('button_text')->comment('Page where slider appears: home, empowering-lives, etc.');
            $table->index('page');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->dropIndex(['page']);
            $table->dropColumn(['button_text', 'page']);
        });
    }
};
