<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->unsignedInteger('total_addresses')->default(0);
            $table->unsignedInteger('total_aliases')->default(0);
            $table->unsignedBigInteger('total_received_emails')->default(0);
            $table->unsignedBigInteger('total_spam_blocked')->default(0);
            $table->unsignedBigInteger('total_api_requests')->default(0);
            $table->unsignedInteger('total_smtp_messages')->default(0);
            $table->unsignedBigInteger('total_storage_bytes')->default(0);
            $table->unsignedInteger('active_addresses')->default(0);
            $table->timestamps();

            $table->index('updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_metrics');
    }
};