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

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

}
