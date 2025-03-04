<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;

    protected $fillable = [
        'peminjam_id',
        'buku_id',
        'rating',
        'ulasan',
    ];

    // many-to-one (Setiap ulasan diberikan untuk satu buku dan berasal dari satu peminjaman)
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

}
