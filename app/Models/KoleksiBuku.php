<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KoleksiBuku extends Model
{
    use HasFactory;

    protected $fillable = [
        'peminjaman_id',
        'buku_id',
    ];

    // satu peminjam bisa menyimpan banyak buku dalam koleksinya
    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }
}
