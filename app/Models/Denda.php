<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Denda extends Model
{
    use HasFactory;

    protected $fillable = [
        'peminjaman_id',
        'nominal',
        'dibayar',
        'status',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function peminjam()
    {
        return $this->peminjaman ? $this->peminjaman->peminjam() : null;
    }

}
