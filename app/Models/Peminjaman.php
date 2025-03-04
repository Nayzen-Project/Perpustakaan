<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Peminjaman extends Model
{
    use HasFactory;
    protected $fillable = [
        'peminjam_id',
        'petugas_id',
        'tanggal_dikembalikan',
        'tanggal_pengembalian',
        'tanggal_peminjaman',
        'status',
    ];
    
    // many-to-one (setiap peminjaman terkait dengan satu peminjam dan satu petugas)
    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class);
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    // one-to-many (satu peminjaman bisa memiliki banyak buku yang dipinjam)
    public function listpeminjaman()
    {
        return $this->hasMany(ListPeminjaman::class);
    }

}
