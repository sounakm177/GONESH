<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_headers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('email_id')->constrained()->cascadeOnDelete();
            $table->string('header_name');
            $table->text('header_value');
            $table->timestamps();

            $table->index('email_id');
            $table->index('header_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_headers');
    }
};
