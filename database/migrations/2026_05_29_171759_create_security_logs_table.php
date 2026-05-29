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
        Schema::create('security_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->index();
            $table->text('user_agent')->nullable();
            $table->string('event_type')->index(); // generate_email, inbox_open, message_received, rate_limit, blocked
            $table->string('email_address')->nullable()->index();
            $table->string('request_path')->nullable();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('security_logs');
    }
};
