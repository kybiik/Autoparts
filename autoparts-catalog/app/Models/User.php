<?php

namespace App\Models;

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

    /**
     * Перевірка чи користувач адміністратор
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Зв'язок: користувач має багато товарів в обраному
     */
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Зв'язок: користувач має багато товарів в кошику
     */
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Зв'язок: користувач має багато логів (якщо адмін)
     */
    public function adminLogs()
    {
        return $this->hasMany(AdminLog::class);
    }

    /**
     * Отримати всі товари з обраного
     */
    public function wishlistProducts()
    {
        return $this->belongsToMany(Product::class, 'wishlists');
    }
}