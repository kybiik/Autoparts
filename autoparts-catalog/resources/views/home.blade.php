@extends('layouts.app')

@section('title', 'AutoParts - Інтернет-магазин автозапчастин')

@section('content')
<!-- Hero Section -->
<section class="hero-modern">
    <canvas id="particles"></canvas>
    <div class="hero-content">
        <h1 class="glitch" data-text="AUTOPARTS">AUTOPARTS</h1>
        <p class="subtitle-modern">Понад {{ \App\Models\Product::count() }} найменувань. Гарантія якості. Швидка доставка по всій Україні.</p>
        <a href="{{ route('products.index') }}" class="cta-button-modern">
            <span>🛍️ Перейти до каталогу</span>
        </a>
        <a href="#stats" class="cta-button-modern">
            <span>📊 Дізнатись більше</span>
        </a>
    </div>
    <div class="scroll-indicator">
        <div class="mouse">
            <div class="wheel"></div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-modern" id="stats">
    <div class="stat-card-modern">
        <div class="stat-icon">📦</div>
        <div class="stat-number" data-target="{{ \App\Models\Product::count() }}">0</div>
        <div class="stat-label">Товарів</div>
    </div>
    <div class="stat-card-modern">
        <div class="stat-icon">✅</div>
        <div class="stat-number">100%</div>
        <div class="stat-label">Якість</div>
    </div>
    <div class="stat-card-modern">
        <div class="stat-icon">🚚</div>
        <div class="stat-number">24/7</div>
        <div class="stat-label">Доставка</div>
    </div>
    <div class="stat-card-modern">
        <div class="stat-icon">⭐</div>
        <div class="stat-number">5.0</div>
        <div class="stat-label">Рейтинг</div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-modern" id="categories">
    <h2 class="section-title-modern">Обери свою категорію</h2>
    <div class="category-grid-modern">
        @foreach($categories as $category)
            <a href="{{ route('categories.show', $category->slug) }}" class="category-card-modern">
                <div class="category-icon">
                    @if($category->slug == 'akumulyatory') 🔋
                    @elseif($category->slug == 'lampochky') 💡
                    @elseif($category->slug == 'elektryka') ⚡
                    @elseif($category->slug == 'aksesuary') 🛠️
                    @elseif($category->slug == 'zapobizhnyky') 🔌
                    @elseif($category->slug == 'provodka') 🔗
                    @endif
                </div>
                <div class="category-name">{{ $category->name }}</div>
                <div class="category-count">{{ $category->products->count() }} товарів</div>
            </a>
        @endforeach
    </div>
</section>

<!-- Featured Products -->
@if($featuredProducts->count() > 0)
<section class="products-modern">
    <h2 class="section-title-modern">🔥 Рекомендовані товари</h2>
    <div class="products-grid-modern">
        @foreach($featuredProducts as $product)
            <div class="product-card-modern">
                <a href="{{ route('products.show', $product->slug) }}">
                    <div class="product-image">
                        @if($product->main_image)
                            <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}">
                        @else
                            <div class="product-placeholder">
                                <span>📦</span>
                            </div>
                        @endif
                        
                        @if($product->hasDiscount())
                            <div style="position: absolute; top: 1rem; right: 1rem; background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; padding: 0.5rem 1rem; border-radius: 1rem; font-weight: 900; font-size: 0.875rem; box-shadow: 0 4px 20px rgba(239, 68, 68, 0.8); z-index: 10;">
                                -{{ $product->getDiscountPercentage() }}%
                            </div>
                        @endif
                    </div>
                </a>
                
                <div class="product-info">
                    <a href="{{ route('categories.show', $product->category->slug) }}" class="product-category">
                        {{ $product->category->name }}
                    </a>
                    
                    <a href="{{ route('products.show', $product->slug) }}">
                        <h3 class="product-name">{{ $product->name }}</h3>
                    </a>
                    
                    <div class="product-price">
                        @if($product->hasDiscount())
                            <span class="old-price">{{ number_format($product->old_price, 0) }} ₴</span>
                        @endif
                        <span class="current-price">{{ number_format($product->price, 0) }} ₴</span>
                    </div>
                    
                        @if(auth()->check())
                            @php
                                $inWishlist = auth()->user()->wishlists()->where('product_id', $product->id)->exists();
                                $wishlistItem = auth()->user()->wishlists()->where('product_id', $product->id)->first();
                            @endphp
                        
                        <div style="display: flex; gap: 0.5rem; align-items: center;">
                            <!-- ФОРМА КОШИКА -->
                            <form action="{{ route('cart.store') }}" method="POST" style="flex: 1;" class="cart-form">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="add-to-cart-btn" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                    🛒 В кошик
                                </button>
                            </form>
                            
                                <!-- ФОРМА WISHLIST (ОКРЕМО!) -->
                            @if($inWishlist)
                                <form action="{{ route('wishlist.destroy', $wishlistItem->id) }}" method="POST" class="wishlist-form" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="wishlist-btn wishlist-active" style="padding: 0.75rem; width: 50px; height: 50px; border-radius: 15px; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); transition: all 0.3s; display: flex; align-items: center; justify-content: center;">
                                        <svg class="heart-icon" fill="currentColor" style="color:#ef4444; width:24px; height:24px;" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </button>
                                </form>
                            @else
                                <form action="{{ route('wishlist.store') }}" method="POST" class="wishlist-form" style="margin:0;" data-product-id="{{ $product->id }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit" class="wishlist-btn" style="padding: 0.75rem; width: 50px; height: 50px; border-radius: 15px; background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px); transition: all 0.3s; display: flex; align-items: center; justify-content: center;">
                                        <svg class="heart-icon" fill="none" style="color:#ffffff; width:24px; height:24px;" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>
                    @else
                        <!-- Для неавторизованих користувачів -->
                        <form action="{{ route('cart.store') }}" method="POST" style="width: 100%;">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="add-to-cart-btn" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                🛒 В кошик
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</section>
@endif
@endsection