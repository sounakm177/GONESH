<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('address_id')->constrained()->cascadeOnDelete();
            $table->string('source', 20)->default('inbox');
            $table->string('message_id')->nullable();
            $table->string('from_name')->nullable();
            $table->string('from_email');
            $table->string('to_email');
            $table->string('subject')->nullable();
            $table->longText('html_body')->nullable();
            $table->longText('text_body')->nullable();
            $table->integer('size')->default(0);
            $table->boolean('has_attachments')->default(false);
            $table->boolean('is_read')->default(false);
            $table->boolean('is_spam')->default(false);
            $table->timestamp('received_at')->nullable();
            $table->timestamps();

            $table->index('address_id');
            $table->index('message_id');
            $table->index('is_read');
            $table->index('is_spam');
            $table->index('received_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('emails');
    }
};
