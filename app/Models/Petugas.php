<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Petugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'email',
        'nama_lengkap',
        'phone',
        'alamat',
        'photo',
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        // Set email dan role sama dengan user saat petugas dibuat
        static::creating(function ($petugas) {
            $petugas->email = $petugas->user->email;
            $petugas->role = $petugas->user->role;
        });

        // Update email dan role jika user berubah
        static::updating(function ($petugas) {
            $petugas->email = $petugas->user->email;
            $petugas->role = $petugas->user->role;
        });

        static::deleting(function ($petugas) {
            $petugas->user()->delete(); // Hapus user terkait
        });
    }
}
