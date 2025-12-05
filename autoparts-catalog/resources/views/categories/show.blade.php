@extends('layouts.app')

@section('title', $category->name . ' - AutoParts')

@section('content')
<!-- Header -->
<div class="relative overflow-hidden bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-600 py-20">
    <div class="absolute inset-0">
        <div class="absolute top-0 left-0 w-72 h-72 bg-white rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
        <div class="absolute top-0 right-0 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <div class="inline-block mb-6">
                <span class="text-8xl">
                    @if($category->slug == 'akumulyatory') 🔋
                    @elseif($category->slug == 'lampochky') 💡
                    @elseif($category->slug == 'elektryka') ⚡
                    @elseif($category->slug == 'aksesuary') 🛠️
                    @elseif($category->slug == 'zapobizhnyky') 🔌
                    @elseif($category->slug == 'provodka') 🔗
                    @endif
                </span>
            </div>
            <h1 class="text-5xl md:text-6xl font-black text-white mb-4">{{ $category->name }}</h1>
            <p class="text-xl text-white/80">Знайдено {{ $products->total() }} товарів</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($products as $product)
                <div class="group card-hover">
                    <div class="relative bg-white rounded-3xl shadow-xl overflow-hidden border-2 border-gray-100 h-full flex flex-col">
                        <a href="{{ route('products.show', $product->slug) }}">
                            <div class="relative h-64 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                                @if($product->main_image)
                                    <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="text-7xl">📦</span>
                                    </div>
                                @endif
                                
                                @if($product->hasDiscount())
                                    <div class="absolute top-4 right-4 bg-gradient-to-r from-red-500 to-pink-600 text-white px-3 py-1 rounded-full text-sm font-black shadow-xl">
                                        -{{ $product->getDiscountPercentage() }}%
                                    </div>
                                @endif
                                
                                @if($product->stock == 0)
                                    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center">
                                        <span class="bg-red-600 text-white px-6 py-3 rounded-2xl font-black shadow-xl">Немає в наявності</span>
                                    </div>
                                @endif
                            </div>
                        </a>
                        
                        <div class="p-6 flex-1 flex flex-col">
                            <a href="{{ route('products.show', $product->slug) }}">
                                <h3 class="font-bold text-gray-900 group-hover:text-purple-600 transition line-clamp-2 min-h-[3rem] text-lg mb-4">
                                    {{ $product->name }}
                                </h3>
                            </a>
                            
                            <div class="mt-auto">
                                <div class="mb-4">
                                    @if($product->hasDiscount())
                                        <div class="flex items-baseline space-x-2">
                                            <span class="text-gray-400 line-through text-sm">{{ number_format($product->old_price, 0) }} ₴</span>
                                            <span class="text-2xl font-black bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">{{ number_format($product->price, 0) }} ₴</span>
                                        </div>
                                    @else
                                        <span class="text-2xl font-black bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">{{ number_format($product->price, 0) }} ₴</span>
                                    @endif
                                </div>
                                
                                <div class="flex gap-2">
                                    <form action="{{ route('cart.store') }}" method="POST" class="flex-1">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="w-full btn-gradient text-white px-4 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition text-sm" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                            🛒 В кошик
                                        </button>
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
                                            <form action="{{ route('wishlist.destroy', $wishlistItem->id) }}" method="POST" class="wishlist-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="wishlist-btn wishlist-active" aria-label="Видалити з обраного">
                                                    <svg class="heart-icon w-5 h-5" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @else
                                            <form action="{{ route('wishlist.store') }}" method="POST" class="wishlist-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="wishlist-btn" aria-label="Додати до обраного">
                                                    <svg class="heart-icon w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    @endauth
        <!-- Пагінація -->
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-20">
            <div class="inline-block p-8 bg-gradient-to-br from-purple-100 to-blue-100 rounded-3xl mb-6">
                <span class="text-8xl">📭</span>
            </div>
            <h3 class="text-3xl font-black text-gray-900 mb-4">Товарів не знайдено</h3>
            <p class="text-gray-600 mb-8">В цій категорії поки немає товарів</p>
            <a href="{{ route('products.index') }}" class="inline-block px-8 py-4 btn-gradient text-white rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition">
                Перейти до каталогу
            </a>
        </div>
    @endif
</div>

<style>
@keyframes blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
}

.animate-blob {
    animation: blob 7s infinite;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection