<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriBuku extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
        'kode',
        'slug',
    ];

    protected $table = 'kategori_bukus';

    // Relasi Many-to-Many dengan Buku melalui list_kategoris
    public function bukus()
    {
        return $this->belongsToMany(Buku::class, 'list_kategoris', 'kategori_buku_id', 'buku_id');
    }

    // Event untuk membuat slug otomatis sebelum menyimpan
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kategori) {
            $kategori->slug = Str::slug($kategori->nama_kategori);
        });
    }
}
