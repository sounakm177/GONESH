<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('domain_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_domain_id')->unique()->constrained('email_domains')->cascadeOnDelete();
            $table->unsignedInteger('total_users')->default(0);
            $table->unsignedInteger('total_addresses')->default(0);
            $table->unsignedBigInteger('total_received_emails')->default(0);
            $table->unsignedInteger('current_daily_emails')->default(0);
            $table->unsignedInteger('active_addresses')->default(0);
            $table->decimal('delivery_rate', 5, 2)->default(0.00);
            $table->decimal('bounce_rate', 5, 2)->default(0.00);
            $table->unsignedSmallInteger('reputation_score')->default(100);
            $table->unsignedInteger('average_receive_time_ms')->default(0);
            $table->timestamps();

            $table->index('updated_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('domain_metrics');
    }
};