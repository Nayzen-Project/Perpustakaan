<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KoleksiBuku extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'buku_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'buku_id');
    }
}
