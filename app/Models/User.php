<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'aktif',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    public function driver()
    {
        return $this->hasOne(Driver::class);
    }

    public function absen()
    {
        return $this->hasMany(Absen::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

     public function pengantarans()
    {
        return $this->hasMany(Pengantaran::class, 'user_id');
    }

    public function adminOrders()
    {
        return $this->hasMany(Order::class, 'admin_id');
    }

    public function gajis()
    {
        return $this->hasMany(Gaji::class);
    }
}
