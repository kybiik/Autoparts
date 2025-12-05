@extends('layouts.app')

@section('title', 'Адмін панель - Товари')

@section('content')
<div class="bg-gradient-to-r from-purple-600 via-blue-600 to-indigo-600 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-black text-white mb-2">⚙️ Адмін панель</h1>
                <p class="text-white/80">Керування товарами</p>
            </div>
            <a href="{{ route('admin.products.create') }}" class="px-6 py-3 bg-white text-purple-600 rounded-xl font-bold shadow-xl hover:shadow-2xl transform hover:scale-105 transition flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Додати товар
            </a>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Статистика -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <div class="bg-gradient-to-br from-purple-500 to-blue-600 rounded-3xl p-6 text-white shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <span class="text-4xl">📦</span>
                <svg class="w-8 h-8 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                </svg>
            </div>
            <div class="text-3xl font-black mb-1">{{ \App\Models\Product::count() }}</div>
            <div class="text-white/80 font-semibold">Всього товарів</div>
        </div>
        
        <div class="bg-gradient-to-br from-green-500 to-emerald-600 rounded-3xl p-6 text-white shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <span class="text-4xl">✅</span>
                <svg class="w-8 h-8 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="text-3xl font-black mb-1">{{ \App\Models\Product::where('stock', '>', 0)->count() }}</div>
            <div class="text-white/80 font-semibold">В наявності</div>
        </div>
        
        <div class="bg-gradient-to-br from-orange-500 to-red-600 rounded-3xl p-6 text-white shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <span class="text-4xl">🔥</span>
                <svg class="w-8 h-8 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            </div>
            <div class="text-3xl font-black mb-1">{{ \App\Models\Product::whereNotNull('old_price')->count() }}</div>
            <div class="text-white/80 font-semibold">Зі знижкою</div>
        </div>
        
        <div class="bg-gradient-to-br from-pink-500 to-purple-600 rounded-3xl p-6 text-white shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <span class="text-4xl">📂</span>
                <svg class="w-8 h-8 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                </svg>
            </div>
            <div class="text-3xl font-black mb-1">{{ \App\Models\Category::count() }}</div>
            <div class="text-white/80 font-semibold">Категорій</div>
        </div>
    </div>
    
    <!-- Фільтри -->
    <div class="bg-white rounded-3xl shadow-xl p-6 mb-8">
        <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-wrap gap-4">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Пошук..." class="flex-1 min-w-[200px] px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-200 transition">
            
            <select name="category" class="px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-purple-600 focus:ring-2 focus:ring-purple-200 transition">
                <option value="">Всі категорії</option>
                @foreach(\App\Models\Category::all() as $cat)
                    <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            
            <button type="submit" class="px-6 py-3 btn-gradient text-white rounded-xl font-bold shadow-lg hover:shadow-xl transform hover:scale-105 transition">
                Застосувати
            </button>
            
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-bold hover:bg-gray-300 transition">
                Скинути
            </a>
        </form>
    </div>
    
    <!-- Таблиця товарів -->
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-purple-600 to-blue-600 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left font-bold">Зображення</th>
                        <th class="px-6 py-4 text-left font-bold">Назва</th>
                        <th class="px-6 py-4 text-left font-bold">Категорія</th>
                        <th class="px-6 py-4 text-left font-bold">Ціна</th>
                        <th class="px-6 py-4 text-left font-bold">Залишок</th>
                        <th class="px-6 py-4 text-right font-bold">Дії</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($products as $product)
                        <tr class="hover:bg-purple-50 transition">
                            <td class="px-6 py-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl overflow-hidden">
                                    @if($product->main_image)
                                        <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="text-2xl">📦</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900">{{ $product->name }}</div>
                                <div class="text-sm text-gray-500">{{ $product->slug }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm font-bold">
                                    {{ $product->category->name }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-black text-purple-600">{{ number_format($product->price, 0) }} ₴</div>
                                @if($product->old_price)
                                    <div class="text-sm text-gray-400 line-through">{{ number_format($product->old_price, 0) }} ₴</div>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($product->stock > 0)
                                    <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm font-bold">
                                        {{ $product->stock }} шт
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-sm font-bold">
                                        Немає
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('products.show', $product->slug) }}" class="p-2 bg-blue-100 text-blue-600 rounded-xl hover:bg-blue-200 transition" title="Переглянути">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 bg-green-100 text-green-600 rounded-xl hover:bg-green-200 transition" title="Редагувати">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Видалити товар?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-red-100 text-red-600 rounded-xl hover:bg-red-200 transition" title="Видалити">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="inline-block p-8 bg-gradient-to-br from-purple-100 to-blue-100 rounded-3xl mb-4">
                                    <span class="text-6xl">📦</span>
                                </div>
                                <p class="text-xl text-gray-600">Товарів не знайдено</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($products->hasPages())
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>
@endsection