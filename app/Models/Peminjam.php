<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'user_id',
        'nama_lengkap',
        'location',
        'alamat',
        'phone',
        'photo',
    ];

     // Memastikan kolom 'location' diperlakukan sebagai array
     protected $casts = [
        'location' => 'array',
    ];
    
    public function peminjaman()
    {
        //  one-to-many (satu peminjam bisa memiliki banyak peminjaman)
        return $this->hasMany(Peminjaman::class);
    }

    protected $table = 'peminjams';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
