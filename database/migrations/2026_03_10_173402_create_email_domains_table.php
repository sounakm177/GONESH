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
        Schema::create('email_domains', function (Blueprint $table) {
            $table->id();
            $table->string('domain', 100)->unique();
            $table->string('label', 100)->nullable();       
            $table->boolean('is_active')->default(true);
            $table->boolean('is_premium')->default(false); 
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();

            $table->index(['is_active', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_domains');
    }
};
