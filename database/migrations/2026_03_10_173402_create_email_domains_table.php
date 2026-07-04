<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_domains', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('display_name', 100)->nullable();
            $table->string('type', 20)->default('free');              // free, pro, custom
            $table->boolean('is_system')->default(false);
            $table->foreignId('created_by_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status', 20)->default('active');           // active, inactive, maintenance
            $table->boolean('mx_verified')->default(false);
            $table->unsignedInteger('priority')->default(0);
            $table->unsignedTinyInteger('health_score')->default(100);
            $table->unsignedTinyInteger('blocked_score')->default(0);
            $table->unsignedInteger('daily_received')->default(0);
            $table->timestamp('last_used_at')->nullable();
            $table->timestamps();

            $table->index(['status', 'priority']);
            $table->index('type');
            $table->index('is_system');
            $table->index('mx_verified');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_domains');
    }
};
