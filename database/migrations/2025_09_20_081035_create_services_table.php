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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Siapa yang punya
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Paket apa yang dibeli
            $table->string('domain'); // Untuk domain apa? misal: domainkeren.com
            $table->enum('status', ['pending', 'active', 'suspended', 'terminated'])->default('pending'); // Status layanan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
