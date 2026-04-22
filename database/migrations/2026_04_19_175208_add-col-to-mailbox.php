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
         Schema::table('public_mailboxes', function (Blueprint $table) {
            // Track when timer was paused; null = not paused
            $table->timestamp('paused_at')->nullable()->after('expires_at');
            // Boolean flag for quick IS-paused checks
            $table->boolean('is_paused')->default(false)->after('paused_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('public_mailboxes', function (Blueprint $table) {
            $table->dropColumn(['paused_at', 'is_paused']);
        });
    }
};
