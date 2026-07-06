<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aliases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('email_domain_id')->constrained()->cascadeOnDelete();
            $table->string('local_part');
            $table->string('email')->unique();
            $table->string('forward_to')->nullable();
            $table->string('description')->nullable();
            $table->boolean('is_enabled')->default(true);
            $table->boolean('is_favorite')->default(false);
            $table->unsignedInteger('total_received')->default(0);
            $table->unsignedInteger('total_forwarded')->default(0);
            $table->timestamp('last_received_at')->nullable();
            $table->timestamps();

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aliases');
    }
};
