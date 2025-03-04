<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListPeminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'buku_id',
        'peminjaman_id',
    ];

    // many-to-one (Setiap buku yang dipinjam terhubung ke satu peminjaman dan satu buku)
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
