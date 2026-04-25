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
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
 
            // ── Sender info ──────────────────────────────────────
            $table->string('name', 120);
            $table->string('email', 255);
 
            // ── Message ──────────────────────────────────────────
            $table->string('subject', 80);   // enum-like value from select
            $table->text('message');
 
            // ── Meta ─────────────────────────────────────────────
            // status: new | read | replied | spam | archived
            $table->enum('status', ['new', 'read', 'replied', 'spam', 'archived'])
                  ->default('new');
 
            // IP stored for abuse tracking only — never exposed publicly
            $table->string('ip_address', 45)->nullable();   // supports IPv6
            $table->string('user_agent')->nullable();
 
            // Admin reply note (internal use only, not sent to user)
            $table->text('admin_note')->nullable();
            $table->timestamp('replied_at')->nullable();
 
            $table->timestamps();
 
            // ── Indexes ──────────────────────────────────────────
            $table->index('status');
            $table->index('email');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
    }
};
