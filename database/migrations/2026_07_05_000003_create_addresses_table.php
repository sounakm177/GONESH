<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('email_domain_id')->constrained('email_domains')->cascadeOnDelete();
            $table->foreignId('alias_id')->nullable()->constrained('addresses')->nullOnDelete();
            $table->string('local_part');
            $table->string('email')->unique();
            $table->string('type', 20)->default('permanent');
            $table->timestamp('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_received_at')->nullable();
            $table->timestamps();

            $table->index('user_id');
            $table->index('email_domain_id');
            $table->index('type');
            $table->index('is_active');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
