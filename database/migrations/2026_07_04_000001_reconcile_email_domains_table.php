<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Only run on existing installs — fresh installs already have the new schema
        if (!Schema::hasColumn('email_domains', 'domain')) {
            return;
        }

        // Drop FK that references the old column name
        Schema::table('public_mailboxes', function (Blueprint $table) {
            $table->dropForeign(['domain']);
        });

        // Rename columns
        Schema::table('email_domains', function (Blueprint $table) {
            $table->renameColumn('domain', 'name');
            $table->renameColumn('label', 'display_name');
            $table->renameColumn('sort_order', 'priority');
        });

        // Add new columns
        Schema::table('email_domains', function (Blueprint $table) {
            $table->string('type', 20)->default('free')->after('display_name');
            $table->boolean('is_system')->default(false)->after('type');
            $table->foreignId('created_by_user_id')->nullable()->constrained('users')->nullOnDelete()->after('is_system');
            $table->string('status', 20)->default('active')->after('created_by_user_id');
            $table->boolean('mx_verified')->default(false)->after('status');
        });

        // Migrate data from old columns
        DB::statement("UPDATE email_domains SET type = IF(is_premium = 1, 'pro', 'free')");
        DB::statement("UPDATE email_domains SET status = IF(is_active = 1, 'active', 'inactive')");

        // Drop old index + columns
        Schema::table('email_domains', function (Blueprint $table) {
            $table->dropIndex(['is_active', 'sort_order']);
            $table->dropColumn(['is_premium', 'is_active']);
        });

        // Create new indexes (safe — only when old schema existed)
        Schema::table('email_domains', function (Blueprint $table) {
            $table->index(['status', 'priority']);
            $table->index('type');
            $table->index('is_system');
            $table->index('mx_verified');
        });

        // Re-add FK referencing the new column name
        Schema::table('public_mailboxes', function (Blueprint $table) {
            $table->foreign('domain')->references('name')->on('email_domains')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        if (!Schema::hasColumn('email_domains', 'name')) {
            return;
        }

        Schema::table('public_mailboxes', function (Blueprint $table) {
            $table->dropForeign(['domain']);
        });

        Schema::table('email_domains', function (Blueprint $table) {
            $table->dropIndex(['status', 'priority']);
            $table->dropIndex(['type']);
            $table->dropIndex(['is_system']);
            $table->dropIndex(['mx_verified']);
        });

        Schema::table('email_domains', function (Blueprint $table) {
            $table->boolean('is_premium')->default(false)->after('display_name');
            $table->boolean('is_active')->default(true)->after('is_premium');
        });

        DB::statement("UPDATE email_domains SET is_premium = (type = 'pro')");
        DB::statement("UPDATE email_domains SET is_active = (status = 'active')");

        Schema::table('email_domains', function (Blueprint $table) {
            $table->dropColumn(['type', 'is_system', 'created_by_user_id', 'status', 'mx_verified']);
        });

        Schema::table('email_domains', function (Blueprint $table) {
            $table->renameColumn('priority', 'sort_order');
            $table->renameColumn('display_name', 'label');
            $table->renameColumn('name', 'domain');
        });

        Schema::table('email_domains', function (Blueprint $table) {
            $table->index(['is_active', 'sort_order']);
        });

        Schema::table('public_mailboxes', function (Blueprint $table) {
            $table->foreign('domain')->references('domain')->on('email_domains')->onDelete('cascade');
        });
    }
};