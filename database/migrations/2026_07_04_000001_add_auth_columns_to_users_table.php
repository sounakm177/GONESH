<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 50)->unique()->nullable()->after('name');
            $table->string('avatar')->nullable()->after('email_verified_at');
            $table->string('google_id')->nullable()->after('password');
            $table->string('github_id')->nullable()->after('google_id');
            $table->string('provider')->nullable()->after('github_id');
            $table->string('stripe_customer_id')->nullable()->after('provider');
            $table->string('status', 20)->default('active')->after('stripe_customer_id');
            $table->timestamp('last_login_at')->nullable()->after('status');
            $table->softDeletes();

            $table->index('username');
            $table->index('status');
            $table->index('google_id');
            $table->index('github_id');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'username',
                'avatar',
                'google_id',
                'github_id',
                'provider',
                'stripe_customer_id',
                'status',
                'last_login_at',
                'deleted_at',
            ]);
        });
    }
};
