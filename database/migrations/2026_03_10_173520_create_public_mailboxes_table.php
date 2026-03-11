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
        Schema::create('public_mailboxes', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->unique();
            $table->string('domain', 100)->index();
            $table->string('session_id', 64)->index();
            $table->timestamp('expires_at')->index();
            $table->timestamps();

            $table->index(['session_id', 'expires_at']);
            $table->foreign('domain')
                  ->references('domain')
                  ->on('email_domains')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_mailboxes');
    }
};
