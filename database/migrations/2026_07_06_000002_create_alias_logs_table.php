<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('alias_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alias_id')->constrained()->cascadeOnDelete();
            $table->foreignId('email_id')->nullable()->constrained()->nullOnDelete();
            $table->string('sender_email')->nullable();
            $table->string('status')->default('received'); // received, forwarded, blocked
            $table->timestamp('created_at')->useCurrent();

            $table->index('alias_id');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('alias_logs');
    }
};
