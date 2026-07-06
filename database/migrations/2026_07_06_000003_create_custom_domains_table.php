<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('custom_domains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('domain', 255)->unique();
            $table->enum('verification_status', ['pending', 'verified', 'failed'])->default('pending');
            $table->boolean('mx_verified')->default(false);
            $table->boolean('spf_verified')->default(false);
            $table->boolean('dkim_verified')->default(false);
            $table->boolean('txt_verified')->default(false);
            $table->text('dkim_value')->nullable();
            $table->text('spf_value')->nullable();
            $table->text('mx_records')->nullable();
            $table->text('txt_value')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('is_selected')->default(false);
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('custom_domains');
    }
};
