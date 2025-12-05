@extends('layouts.app')

@section('title', 'Каталог товарів - AutoParts')

@section('content')
<!-- Header -->
<div class="bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-600 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-5xl font-black text-white mb-4">Каталог товарів</h1>
            <p class="text-xl text-white/80">Знайдено {{ $products->total() }} товарів</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Фільтри -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-3xl shadow-xl p-6 sticky top-24">
                <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/>
                    </svg>
                    Фільтри
                </h2>
                
                <form action="{{ route('products.index') }}" method="GET" class="space-y-6">
                    <!-- Пошук -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">🔍 Пошук</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Назва товару..." class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-200 transition">
                    </div>
                    
                    <!-- Категорія -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">📂 Категорія</label>
                        <select name="category" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-200 transition">
                            <option value="">Всі категорії</option>
                            @foreach(\App\Models\Category::all() as $cat)
                                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Ціна -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">💰 Ціна (грн)</label>
                        <div class="flex gap-2">
                            <input type="number" name="price_from" value="{{ request('price_from') }}" placeholder="Від" class="w-1/2 px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-200 transition">
                            <input type="number" name="price_to" value="{{ request('price_to') }}" placeholder="До" class="w-1/2 px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-200 transition">
                        </div>
                    </div>
                    
                    <!-- Сортування -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">🔄 Сортування</label>
                        <select name="sort" class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-200 transition">
                            <option value="new" {{ request('sort') == 'new' ? 'selected' : '' }}>Нові</option>
                            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Дешевші</option>
                            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Дорожчі</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>За назвою</option>
                        </select>
                    </div>
                    
                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 btn-gradient text-white px-4 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition">
                            Застосувати
                        </button>
                        <a href="{{ route('products.index') }}" class="px-4 py-3 bg-gray-200 text-gray-700 rounded-xl font-bold hover:bg-gray-300 transition">
                            ✕
                        </a>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Товари -->
        <div class="lg:w-3/4">
            @if($products->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
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
                                    <a href="{{ route('categories.show', $product->category->slug) }}" class="inline-block px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-xs font-bold mb-3 hover:bg-purple-200 transition w-fit">
                                        {{ $product->category->name }}
                                    </a>
                                    
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
                                                    <form action="{{ route('wishlist.destroy', $wishlistItem->id) }}" method="POST" class="wishlist-form" data-product-id="{{ $product->id }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="wishlist-btn wishlist-active" aria-label="Видалити з обраного">
                                                            <svg class="heart-icon w-5 h-5" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('wishlist.store') }}" method="POST" class="wishlist-form" data-product-id="{{ $product->id }}">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Пагінація -->
                <div class="mt-12">
                    {{ $products->links() }}
                </div>
            @else
                <div class="text-center py-20">
                    <div class="inline-block p-8 bg-gradient-to-br from-purple-100 to-blue-100 rounded-3xl mb-6">
                        <span class="text-8xl">🔍</span>
                    </div>
                    <h3 class="text-3xl font-black text-gray-900 mb-4">Товарів не знайдено</h3>
                    <p class="text-gray-600 mb-8">Спробуйте змінити параметри пошуку</p>
                    <a href="{{ route('products.index') }}" class="inline-block px-8 py-4 btn-gradient text-white rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition">
                        Скинути фільтри
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection