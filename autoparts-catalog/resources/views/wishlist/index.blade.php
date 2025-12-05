@extends('layouts.app')

@section('title', 'Обране - AutoParts')

@section('content')
<div class="bg-gradient-to-r from-pink-600 via-red-600 to-purple-600 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-5xl font-black text-white mb-4">❤️ Обране</h1>
            <p class="text-xl text-white/80 wishlist-items-count">{{ $wishlistItems->count() }} {{ $wishlistItems->count() == 1 ? 'товар' : 'товарів' }}</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($wishlistItems->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($wishlistItems as $item)
                <div class="group card-hover wishlist-item" data-wishlist-id="{{ $item->id }}">
                    <div class="relative bg-white rounded-3xl shadow-xl overflow-hidden border-2 border-gray-100 h-full flex flex-col">
                        <a href="{{ route('products.show', $item->product->slug) }}">
                            <div class="relative h-64 bg-gradient-to-br from-gray-100 to-gray-200 overflow-hidden">
                                @if($item->product->main_image)
                                    <img src="{{ asset('storage/' . $item->product->main_image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-500">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <span class="text-7xl">📦</span>
                                    </div>
                                @endif
                                
                                @if($item->product->hasDiscount())
                                    <div class="absolute top-4 right-4 bg-gradient-to-r from-red-500 to-pink-600 text-white px-3 py-1 rounded-full text-sm font-black shadow-xl">
                                        -{{ $item->product->getDiscountPercentage() }}%
                                    </div>
                                @endif
                                
                                <!-- Видалити з обраного -->
                                <form action="{{ route('wishlist.destroy', $item->id) }}" method="POST" class="absolute top-4 left-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-3 bg-white/90 backdrop-blur-sm text-red-600 rounded-xl hover:bg-white transition shadow-lg transform hover:scale-110">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </a>
                        
                        <div class="p-6 flex-1 flex flex-col">
                            <a href="{{ route('categories.show', $item->product->category->slug) }}" class="inline-block px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-xs font-bold mb-3 hover:bg-purple-200 transition w-fit">
                                {{ $item->product->category->name }}
                            </a>
                            
                            <a href="{{ route('products.show', $item->product->slug) }}">
                                <h3 class="font-bold text-gray-900 group-hover:text-purple-600 transition line-clamp-2 min-h-[3rem] text-lg mb-4">
                                    {{ $item->product->name }}
                                </h3>
                            </a>
                            
                            <div class="mt-auto">
                                <div class="mb-4">
                                    @if($item->product->hasDiscount())
                                        <div class="flex items-baseline space-x-2">
                                            <span class="text-gray-400 line-through text-sm">{{ number_format($item->product->old_price, 0) }} ₴</span>
                                            <span class="text-2xl font-black bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">{{ number_format($item->product->price, 0) }} ₴</span>
                                        </div>
                                    @else
                                        <span class="text-2xl font-black bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">{{ number_format($item->product->price, 0) }} ₴</span>
                                    @endif
                                </div>
                                
                                <form action="{{ route('cart.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full btn-gradient text-white px-4 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition text-sm" {{ $item->product->stock == 0 ? 'disabled' : '' }}>
                                        🛒 В кошик
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Порожнє обране -->
        <div class="text-center py-20">
            <div class="inline-block p-12 bg-gradient-to-br from-pink-100 to-red-100 rounded-full mb-8">
                <svg class="w-32 h-32 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <h2 class="text-4xl font-black text-gray-900 mb-4">Ваш список обраного порожній</h2>
            <p class="text-xl text-gray-600 mb-8">Додайте товари до обраного, щоб не загубити їх</p>
            <a href="{{ route('products.index') }}" class="inline-block px-10 py-5 btn-gradient text-white rounded-2xl font-black text-lg shadow-xl hover:shadow-2xl transform hover:scale-105 transition">
                Перейти до каталогу
            </a>
        </div>
    @endif
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