<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'description',
        'code',
        'tahun_terbit',
        'jumlah',
    ];

    public function kategoribuku() 
    {
        // many-to-many (Satu buku bisa memiliki banyak kategori dan satu kategori bisa memiliki banyak buku)
        return $this->belongsToMany(KategoriBuku::class, 'list_kategori');
    }
}
