<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListKategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_buku_id',
        'buku_id',
    ];

    
}
