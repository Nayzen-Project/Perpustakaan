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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->string('kode_peminjaman')->unique(); // Kode unik untuk peminjaman
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('peminjam_id')->constrained('peminjams')->onDelete('cascade');
            $table->foreignId('petugas_id')->nullable()->constrained('petugas')->onDelete('cascade');
            $table->date('tanggal_dikembalikan')->nullable(); // Bisa null jika belum dikembalikan
            $table->date('tanggal_pengembalian'); // Tanggal yang diharapkan dikembalikan
            $table->date('tanggal_peminjaman'); // Tanggal buku dipinjam
            $table->enum('status', ['dipinjam', 'dikembalikan', 'menunggu pengambilan', 'telat dikembalikan'])
                  ->default('menunggu pengambilan');
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
