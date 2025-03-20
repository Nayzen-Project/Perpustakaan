<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;
    protected $fillable = [
        'kode_peminjaman', 'peminjam_id', 'petugas_id',
        'tanggal_peminjaman', 'tanggal_pengembalian',
        'tanggal_dikembalikan', 'status'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($peminjaman) {
            $peminjaman->kode_peminjaman = 'PMX-' . strtoupper(Str::random(3));
        });
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    // Relasi ke daftar buku yang dipinjam
    public function listPeminjaman()
    {
        return $this->hasMany(ListPeminjaman::class, 'peminjaman_id');
    }

    // Menghubungkan ke model Buku melalui list_pinjaman
    public function buku()
    {
        return $this->hasManyThrough(Buku::class, ListPeminjaman::class, 'peminjaman_id', 'id', 'id', 'buku_id');
    }

    // Relasi ke peminjam
    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'peminjam_id');
    }

    public function denda()
    {
        return $this->hasOne(Denda::class);
    }

}
