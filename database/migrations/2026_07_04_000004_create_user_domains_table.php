<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_domains', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('email_domain_id')->constrained('email_domains')->cascadeOnDelete();
            $table->string('subdomain', 100)->nullable();
            $table->boolean('is_default')->default(false);
            $table->string('status', 20)->default('active'); // active, inactive
            $table->timestamps();

            $table->unique(['user_id', 'subdomain']);
            $table->index(['user_id', 'is_default']);
            $table->index(['user_id', 'status']);
            $table->index('email_domain_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_domains');
    }
};