@extends('layouts.app')

@section('title', 'Профіль — ' . ($user->name ?? ''))

@section('content')
<div class="py-12 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-black text-gray-900">Профіль</h1>
            <p class="text-gray-500 mt-1">Керування персональними даними та швидкий доступ до обраного й кошика</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Ліва колонка: форма -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-[24px] p-6 shadow-xl">
                    <h2 class="text-xl font-bold mb-4">Особисті дані</h2>
                    @include('profile.partials.update-profile-information-form')
                </div>

                <div class="mt-6 bg-white rounded-[24px] p-6 shadow-xl">
                    <h2 class="text-xl font-bold mb-4">Безпека</h2>
                    @include('profile.partials.update-password-form')
                </div>

                <div class="mt-6 bg-white rounded-[24px] p-6 shadow-xl">
                    <h2 class="text-xl font-bold mb-4">Акаунт</h2>
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

            <!-- Права колонка: обране та кошик -->
            <div class="space-y-6">
                <div class="bg-white rounded-[20px] p-4 shadow">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-lg">Обране</h3>
                        <a href="{{ route('wishlist.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Переглянути все</a>
                    </div>

                    @if(isset($wishlistProducts) && $wishlistProducts->isEmpty())
                        <div class="text-gray-500">У вас поки що немає товарів в обраному.</div>
                    @else
                                        <div class="grid grid-cols-2 gap-3">
                                            @foreach($wishlistProducts as $product)
                                                <a href="{{ route('products.show', $product->slug) }}" class="group flex items-center gap-3 p-2 rounded-lg transition hover:bg-gradient-to-r hover:from-purple-600 hover:to-blue-600 hover:text-white hover:shadow-lg">
                                                    <div class="w-14 h-14 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                                                        @if($product->images->first())
                                                            <img src="{{ asset('storage/' . $product->images->first()->image_path) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                                        @else
                                                            <span class="text-2xl">📦</span>
                                                        @endif
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="text-sm font-bold text-gray-800 group-hover:text-white">{{ Str::limit($product->name, 40) }}</div>
                                                        <div class="text-sm text-gray-500 group-hover:text-white">{{ number_format($product->price, 0) }} ₴</div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                    @endif
                </div>

                <div class="bg-white rounded-[20px] p-4 shadow">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="font-bold text-lg">Останні в кошику</h3>
                        <a href="{{ route('cart.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Переглянути кошик</a>
                    </div>

                    @if(isset($recentCartItems) && $recentCartItems->isEmpty())
                        <div class="text-gray-500">Немає доданих позицій.</div>
                    @else
                        <div class="space-y-3">
                            @foreach($recentCartItems ?? collect() as $item)
                                <div class="group flex items-center gap-3 p-2 rounded-lg transition hover:bg-gradient-to-r hover:from-purple-600 hover:to-blue-600 hover:text-white hover:shadow-lg">
                                    <div class="w-12 h-12 bg-gray-100 rounded-lg overflow-hidden flex items-center justify-center">
                                        @if($item->product && $item->product->main_image)
                                            <img src="{{ asset('storage/' . $item->product->main_image) }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-lg">📦</span>
                                        @endif
                                    </div>
                                    <div class="flex-1 text-sm">
                                        <div class="font-bold text-gray-800 group-hover:text-white">{{ $item->product ? Str::limit($item->product->name, 50) : 'Товар' }}</div>
                                        <div class="text-gray-500 group-hover:text-white">Кількість: {{ $item->quantity }} • {{ number_format($item->price, 0) }} ₴</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
