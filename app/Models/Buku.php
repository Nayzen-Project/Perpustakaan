<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'bukus';

    protected $fillable = [
        'judul',
        'judul',
        'penulis',
        'penerbit',
        'description',
        'code',
        'tahun_terbit',
        'jumlah',
        'foto',
    ];

    public function kategori()
    {
        return $this->belongsToMany(KategoriBuku::class, 'list_kategoris', 'buku_id', 'kategori_buku_id');
    }

    public function updateKategoriKode()
    {
    // Ambil semua kode kategori yang tersisa setelah penghapusan
    $kodeKategori = $this->kategori()->pluck('kode')->implode('');

    // Pastikan ID tetap ada dalam kode buku
    $newKode = empty($kodeKategori) ? 'B' . str_pad($this->id, 2, '0', STR_PAD_LEFT) : strtoupper($kodeKategori) . str_pad($this->id, 2, '0', STR_PAD_LEFT);

    // Update kode di buku
    $this->update(['code' => $newKode]);
    }

    // Buat slug otomatis saat buku baru dibuat atau diperbarui
    public static function boot()
    {
        parent::boot();

        static::creating(function ($buku) {
            $buku->slug = Str::slug($buku->judul, '-'); // Mengubah judul menjadi slug
        });

        static::updating(function ($buku) {
            $buku->slug = Str::slug($buku->judul, '-'); // Update slug saat judul diubah
        });
    }

    public function koleksiBukus()
    {
        return $this->hasMany(KoleksiBuku::class, 'buku_id');
    }

    public function listPeminjaman()
    {
        return $this->hasMany(ListPeminjaman::class);
    }

    public function ulasans()
    {
        return $this->hasMany(Ulasan::class);
    }

}
