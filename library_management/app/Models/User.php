<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // thêm role
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Quan hệ 1-nhiều: Một user có thể mượn nhiều sách
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    // Kiểm tra quyền admin
    public function isAdmin() {
        return $this->role === 'admin';
    }
}
