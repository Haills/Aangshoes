<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone', // Tambahkan ini
        'address' // Tambahkan ini
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed'
    ];

    public function isAdmin(): bool
    {
        return $this->role === 'admin'; // Assuming you have a 'role' column
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
