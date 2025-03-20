<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjam extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'location',
        'alamat',
        'phone',
        'photo',
        'status',
        'nik', 'foto_ktp',
    ];

     // Memastikan kolom 'location' diperlakukan sebagai array
     protected $casts = [
        'location' => 'array',
    ];
    
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'peminjam_id');
    }

    protected $table = 'peminjams';

    public function user()
    {
        return $this->belongsTo(User::class); // Hubungkan kembali ke user
    }

    public function koleksiBukus()
    {
        return $this->hasMany(KoleksiBuku::class, 'peminjam_id');
    }

}
