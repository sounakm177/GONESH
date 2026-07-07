<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('email_domains', function (Blueprint $table) {
            $table->json('features')->nullable()->after('mx_verified');
            $table->unsignedTinyInteger('acceptance')->default(0)->after('features');
            $table->json('best_for')->nullable()->after('acceptance');
            $table->text('restrictions')->nullable()->after('best_for');
            $table->boolean('popular')->default(false)->after('restrictions');
            $table->boolean('exclusive')->default(false)->after('popular');
        });
    }

    public function down(): void
    {
        Schema::table('email_domains', function (Blueprint $table) {
            $table->dropColumn(['features', 'acceptance', 'best_for', 'restrictions', 'popular', 'exclusive']);
        });
    }
};
