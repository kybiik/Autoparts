<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'specifications',
        'sku',
        'price',
        'old_price',
        'stock',
        'manufacturer',
        'country',
        'warranty',
        'main_image',
        'is_featured',
        'is_active',
        'views'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    // Автоматичне створення slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
            }
        });

        static::updating(function ($product) {
            if ($product->isDirty('name')) {
                $product->slug = Str::slug($product->name);
            }
        });
    }

    // Зв'язок: товар належить до категорії
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Зв'язок: товар має багато зображень
    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('order');
    }

    // Зв'язок: товар може бути в обраному
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // Зв'язок: товар може бути в кошику
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    // Перевірка чи товар в обраному у користувача
    public function isInWishlist($userId)
    {
        return $this->wishlists()->where('user_id', $userId)->exists();
    }

    // Scope для активних товарів
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope для рекомендованих товарів
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    // Scope для товарів в наявності
    public function scopeInStock($query)
    {
        return $query->where('stock', '>', 0);
    }

    // Scope для пошуку
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('sku', 'like', "%{$search}%");
        });
    }

    // Scope для фільтрації за ціною
    public function scopePriceRange($query, $min, $max)
    {
        return $query->whereBetween('price', [$min, $max]);
    }

    // Перевірка наявності знижки
    public function hasDiscount()
    {
        return $this->old_price && $this->old_price > $this->price;
    }

    // Відсоток знижки
    public function getDiscountPercentage()
    {
        if ($this->hasDiscount()) {
            return round((($this->old_price - $this->price) / $this->old_price) * 100);
        }
        return 0;
    }

    // Збільшення лічильника переглядів
    public function incrementViews()
    {
        $this->increment('views');
    }
}