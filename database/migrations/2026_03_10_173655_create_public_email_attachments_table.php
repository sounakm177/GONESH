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
        Schema::create('public_email_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_id')
                  ->constrained('public_emails')
                  ->onDelete('cascade');
            $table->string('file_name', 255);
            $table->string('file_path', 500);   // storage-relative path
            $table->unsignedBigInteger('file_size')->default(0); // bytes
            $table->string('mime_type', 127)->default('application/octet-stream');
            $table->timestamps();

            $table->index('email_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('public_email_attachments');
    }
};
