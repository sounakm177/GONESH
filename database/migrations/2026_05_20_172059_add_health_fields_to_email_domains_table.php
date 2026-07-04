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
        if (Schema::hasColumn('email_domains', 'health_score')) {
            return;
        }

        Schema::table('email_domains', function (Blueprint $table) {
              // Reputation / health tracking
            $table->unsignedTinyInteger('health_score')
                ->default(100)
                ->after('is_active');

            // Domain blocking reputation
            $table->unsignedTinyInteger('blocked_score')
                ->default(0)
                ->after('health_score');

            // Daily received email count
            $table->unsignedInteger('daily_received')
                ->default(0)
                ->after('blocked_score');

            // Last usage timestamp
            $table->timestamp('last_used_at')
                ->nullable()
                ->after('daily_received');

        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('email_domains', 'health_score')) {
            return;
        }

        Schema::table('email_domains', function (Blueprint $table) {
             $table->dropColumn([
                'health_score',
                'blocked_score',
                'daily_received',
                'last_used_at',
            ]);
        });
    }
};
