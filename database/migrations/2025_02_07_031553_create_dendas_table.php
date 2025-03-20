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
        Schema::create('dendas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('peminjaman_id')->constrained('peminjamen')->onDelete('cascade');
            $table->integer('nominal');
            $table->boolean('dibayar')->default(false);
            $table->enum('status', ['dibayar', 'belum dibayar'])->default('belum dibayar'); ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dendas');
    }
};
