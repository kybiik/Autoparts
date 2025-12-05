@extends('layouts.app')

@section('title', $product->name . ' - AutoParts')

@section('content')
<div class="bg-gradient-to-br from-gray-50 to-blue-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumbs -->
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm">
                <li><a href="{{ route('home') }}" class="text-gray-600 hover:text-purple-600 transition">Головна</a></li>
                <li class="text-gray-400">→</li>
                <li><a href="{{ route('products.index') }}" class="text-gray-600 hover:text-purple-600 transition">Каталог</a></li>
                <li class="text-gray-400">→</li>
                <li><a href="{{ route('categories.show', $product->category->slug) }}" class="text-gray-600 hover:text-purple-600 transition">{{ $product->category->name }}</a></li>
                <li class="text-gray-400">→</li>
                <li class="font-bold text-gray-900">{{ $product->name }}</li>
            </ol>
        </nav>
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Зображення -->
            <div>
                <div class="bg-white rounded-3xl shadow-2xl overflow-hidden sticky top-24">
                    <div class="relative">
                        @if($product->main_image)
                            <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-[500px] object-cover">
                        @else
                            <div class="w-full h-[500px] bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                <span class="text-9xl">📦</span>
                            </div>
                        @endif
                        
                        @if($product->hasDiscount())
                            <div class="absolute top-6 right-6 bg-gradient-to-r from-red-500 to-pink-600 text-white px-6 py-3 rounded-2xl text-lg font-black shadow-2xl">
                                -{{ $product->getDiscountPercentage() }}% ЗНИЖКА
                            </div>
                        @endif
                        
                        @if($product->stock == 0)
                            <div class="absolute inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center">
                                <span class="bg-red-600 text-white px-8 py-4 rounded-2xl font-black text-xl shadow-2xl">Немає в наявності</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
<div class="max-w-md mx-auto space-y-6">
    
    <div class="bg-white rounded-[30px] p-8 shadow-2xl">
        
        <div class="flex items-center gap-2 mb-4">
            <span class="text-yellow-500">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"/>
                </svg>
            </span>
            <a href="{{ route('categories.show', $product->category->slug) }}" 
               class="text-xs font-bold tracking-wider uppercase text-gray-400 hover:text-purple-600 transition-colors">
                {{ $product->category->name }}
            </a>
        </div>

        <h1 class="text-3xl font-black text-gray-900 leading-tight mb-6">
            {{ $product->name }}
        </h1>

        <div class="flex items-center justify-between mb-8">
            <div>
                @if($product->hasDiscount())
                    <div class="flex items-center gap-2 mb-1">
                        <span class="text-sm text-gray-400 line-through font-bold">{{ number_format($product->old_price, 0) }} ₴</span>
                        <span class="bg-rose-100 text-rose-500 text-[10px] px-2 py-0.5 rounded font-bold">
                            -{{ $product->getDiscountPercentage() }}%
                        </span>
                    </div>
                @endif
                <div class="text-4xl font-black text-purple-600">
                    {{ number_format($product->price, 0) }} ₴
                </div>
            </div>

            <div>
                @if($product->stock > 0)
                    <div class="bg-emerald-100 text-emerald-600 px-4 py-2 rounded-xl text-sm font-bold flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        В наявності: {{ $product->stock }} шт
                    </div>
                @else
                    <div class="bg-red-100 text-red-500 px-4 py-2 rounded-xl text-sm font-bold flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-red-500"></span>
                        Немає в наявності
                    </div>
                @endif
            </div>
        </div>

        <div class="flex gap-3 mb-6">
            <form action="{{ route('cart.store') }}" method="POST" class="flex-1">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="flex">
                    <div class="flex items-center bg-gray-100 rounded-xl h-[60px] px-1 mr-3">
                        <button type="button" onclick="decreaseQuantity()" class="w-10 h-full text-gray-400 hover:text-gray-900 text-xl font-bold transition">−</button>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $product->stock }}" 
                               class="w-10 bg-transparent text-center text-gray-900 font-bold border-none focus:ring-0 p-0 text-xl">
                        <button type="button" onclick="increaseQuantity()" class="w-10 h-full text-gray-400 hover:text-gray-900 text-xl font-bold transition">+</button>
                    </div>

                    <button type="submit" {{ $product->stock == 0 ? 'disabled' : '' }}
                            class="flex-1 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded-xl h-[60px] flex items-center justify-center gap-2 transition-all shadow-lg shadow-purple-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        <span>Додати в кошик</span>
                    </button>
                </div>
            </form>

            @auth
                @php
                    $inWishlist = false;
                    $wishlistItem = null;
                    if(auth()->check()) {
                        $wishlistItem = auth()->user()->wishlists()->where('product_id', $product->id)->first();
                        $inWishlist = (bool) $wishlistItem;
                    }
                @endphp
                @if($inWishlist)
                    <form action="{{ route('wishlist.destroy', $wishlistItem->id) }}" method="POST" class="wishlist-form" data-product-id="{{ $product->id }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="wishlist-btn wishlist-active" aria-label="Видалити з обраного">
                            <svg class="heart-icon w-6 h-6" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </form>
                @else
                    <form action="{{ route('wishlist.store') }}" method="POST" class="wishlist-form" data-product-id="{{ $product->id }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <button type="submit" class="wishlist-btn" aria-label="Додати до обраного">
                            <svg class="heart-icon w-6 h-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </form>
                @endif
            @endauth
        </div>

        <div class="grid grid-cols-2 gap-3">
            <div class="bg-gray-100 p-4 rounded-xl flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-white text-green-500 shadow-sm flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <span class="text-sm font-bold text-gray-600">Гарантія якості</span>
            </div>
            
            <div class="bg-gray-100 p-4 rounded-xl flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-white text-blue-500 shadow-sm flex items-center justify-center shrink-0">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <span class="text-sm font-bold text-gray-600">Швидка доставка</span>
            </div>
        </div>
    </div>

    @if($product->description)
        <div class="bg-white rounded-[30px] p-8 shadow-xl">
            <h2 class="text-xl font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                </svg>
                Опис товару
            </h2>
            <div class="prose max-w-none text-gray-600 leading-relaxed">
                {{ $product->description }}
            </div>
        </div>
    @endif

</div>

<script>
    function increaseQuantity() {
        let input = document.getElementById('quantity');
        let max = parseInt(input.getAttribute('max'));
        let val = parseInt(input.value);
        if(val < max) input.value = val + 1;
    }
    function decreaseQuantity() {
        let input = document.getElementById('quantity');
        let val = parseInt(input.value);
        if(val > 1) input.value = val - 1;
    }
</script>

<script>
    function increaseQuantity() {
        let input = document.getElementById('quantity');
        let max = parseInt(input.getAttribute('max'));
        let val = parseInt(input.value);
        if(val < max) input.value = val + 1;
    }
    function decreaseQuantity() {
        let input = document.getElementById('quantity');
        let val = parseInt(input.value);
        if(val > 1) input.value = val - 1;
    }
</script>

<script>
function increaseQuantity() {
    const input = document.getElementById('quantity');
    const max = parseInt(input.max);
    const current = parseInt(input.value);
    if (current < max) {
        input.value = current + 1;
    }
}

function decreaseQuantity() {
    const input = document.getElementById('quantity');
    const current = parseInt(input.value);
    if (current > 1) {
        input.value = current - 1;
    }
}
</script>
@endsection