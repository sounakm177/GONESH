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
        Schema::create('public_emails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mailbox_id')
                  ->constrained('public_mailboxes')
                  ->onDelete('cascade');   // auto-cleanup when mailbox deleted
            $table->string('sender', 255);
            $table->string('subject', 500)->default('(no subject)');
            $table->longText('body');
            $table->string('content_type', 50)->default('text/plain'); // text/plain | text/html
            $table->boolean('is_read')->default(false);
            $table->timestamp('received_at')->useCurrent()->index();

            $table->fullText(['subject', 'sender']);
            $table->index(['mailbox_id', 'is_read']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_emails');
    }
};
