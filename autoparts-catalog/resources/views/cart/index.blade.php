@extends('layouts.app')

@section('title', 'Кошик - AutoParts')

@section('content')
<div class="bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-600 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h1 class="text-5xl font-black text-white mb-4">🛒 Кошик</h1>
            <p class="text-xl text-white/80">{{ $cartItems->count() }} {{ $cartItems->count() == 1 ? 'товар' : 'товарів' }}</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Товари -->
            <div class="lg:col-span-2 space-y-6">
                @foreach($cartItems as $item)
                    <div data-cart-id="{{ $item->id }}" data-unit-price="{{ $item->product->price }}" class="bg-white rounded-3xl shadow-xl p-6 hover:shadow-2xl transition">
                        <div class="flex gap-6">
                            <!-- Зображення -->
                            <a href="{{ route('products.show', $item->product->slug) }}" class="flex-shrink-0">
                                <div class="w-32 h-32 bg-gradient-to-br from-gray-100 to-gray-200 rounded-2xl overflow-hidden">
                                    @if($item->product->main_image)
                                        <img src="{{ asset('storage/' . $item->product->main_image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="text-5xl">📦</span>
                                        </div>
                                    @endif
                                </div>
                            </a>
                            
                            <!-- Інфо -->
                            <div class="flex-1">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <a href="{{ route('categories.show', $item->product->category->slug) }}" class="inline-block px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-xs font-bold mb-2 hover:bg-purple-200 transition">
                                            {{ $item->product->category->name }}
                                        </a>
                                        <a href="{{ route('products.show', $item->product->slug) }}">
                                            <h3 class="text-xl font-bold text-gray-900 hover:text-purple-600 transition">{{ $item->product->name }}</h3>
                                        </a>
                                    </div>
                                    
                                    <!-- Видалити -->
                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-xl transition">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                                
                                <div class="flex justify-between items-end">
                                    <!-- Кількість -->
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PATCH')
                                        <div class="flex items-center border-2 border-gray-200 rounded-xl overflow-hidden">
                                            <button type="button" onclick="handleCartQtyClick(event,this,-1)" class="px-4 py-2 bg-gray-100 transition font-bold">-</button>
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}" class="w-16 text-center font-bold border-0 focus:ring-0" onchange="handleCartQtyInputChange(event,this)">
                                            <button type="button" onclick="handleCartQtyClick(event,this,1)" class="px-4 py-2 bg-gray-100 transition font-bold">+</button>
                                        </div>
                                    </form>
                                    
                                    <!-- Ціна -->
                                    <div class="text-right">
                                        <div class="text-2xl font-black bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent item-subtotal" data-cart-id="{{ $item->id }}">
                                            {{ number_format($item->product->price * $item->quantity, 0) }} ₴
                                        </div>
                                        <div class="text-sm text-gray-500">{{ number_format($item->product->price, 0) }} ₴ / шт</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Підсумок -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-3xl shadow-2xl p-8 sticky top-24">
                    <h2 class="text-2xl font-black text-gray-900 mb-6">Разом</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span class="items-count">Товарів ({{ $cartItems->sum('quantity') }} шт):</span>
                            <span class="font-bold total-price">{{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 0) }} ₴</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Доставка:</span>
                            <span class="font-bold text-green-600">Безкоштовно</span>
                        </div>
                        <div class="border-t-2 border-gray-200 pt-4">
                            <div class="flex justify-between items-baseline">
                                <span class="text-lg font-bold text-gray-900">До сплати:</span>
                                <span class="text-3xl font-black bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent total-price">
                                    {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 0) }} ₴
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <a href="{{ route('products.index') }}" class="block w-full text-center px-6 py-4 bg-gray-100 text-gray-700 rounded-2xl font-bold hover:bg-gray-200 transition mb-4">
                        Продовжити покупки
                    </a>
                    
                    <!-- Безпека (кнопка) - стиль як у 'Продовжити покупки' (той же padding і font), фон зелений, без зміни фону на hover -->
                    <button type="button" id="secure-pay-btn" class="block w-full text-center px-6 py-4 bg-green-600 text-white rounded-2xl font-bold mb-4 transition flex items-center justify-center">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-2 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span class="font-bold">Безпечна оплата</span>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    @else
        <!-- Порожній кошик -->
        <div class="text-center py-20">
            <div class="inline-block p-12 bg-gradient-to-br from-purple-100 to-blue-100 rounded-full mb-8">
                <svg class="w-32 h-32 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <h2 class="text-4xl font-black text-gray-900 mb-4">Ваш кошик порожній</h2>
            <p class="text-xl text-gray-600 mb-8">Додайте товари до кошика, щоб продовжити</p>
            <a href="{{ route('products.index') }}" class="inline-block px-10 py-5 btn-gradient text-white rounded-2xl font-black text-lg shadow-xl hover:shadow-2xl transform hover:scale-105 transition">
                Перейти до каталогу
            </a>
        </div>
    @endif
</div>
@endsection