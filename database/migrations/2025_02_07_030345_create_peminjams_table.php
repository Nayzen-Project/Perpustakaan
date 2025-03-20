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
        Schema::create('peminjams', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_lengkap');
            $table->json('location'); // Menyimpan provinsi, kabupaten, kecamatan dalam format JSON
            $table->string('alamat');
            $table->string('phone');
            $table->string('photo')->nullable();
            $table->enum('status', ['active', 'nonactive'])->default('active');
            $table->string('nik')->nullable()->unique();
            $table->string('foto_ktp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjams');
    }
};
