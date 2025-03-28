<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_confirmed',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function petugas()
    {
        return $this->hasOne(Petugas::class, 'user_id', 'id');
    }

    public function peminjam()
    {
        return $this->hasOne(Peminjam::class, 'user_id');
    }

    public function koleksiBukus()
    {
        return $this->hasMany(KoleksiBuku::class, 'user_id');
    }

    public function denda()
    {
        return $this->hasManyThrough(Denda::class, Peminjaman::class);
    }

}
