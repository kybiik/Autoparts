<!DOCTYPE html>
<html lang="uk" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'AutoParts - Інтернет-магазин автозапчастин')</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
<style>
/* ==================== ТЕМНА ТЕМА ДЛЯ AUTOPARTS ==================== */

/* ========== БАЗОВІ СТИЛІ ========== */
body {
    background: linear-gradient(135deg, #0a0a0f 0%, #1a1a2e 50%, #16213e 100%) !important;
    background-attachment: fixed;
    min-height: 100vh;
}

main > div,
main > .container,
.max-w-7xl {
    background: transparent !important;
}

/* ========== HEADER І NAVIGATION ========== */
header,
nav {
    background: transparent !important;
}

/* ========== КАРТКИ І КОНТЕЙНЕРИ ========== */

/* Базові білі картки → темні */
.bg-white:not(header):not(nav):not(button) {
    background: rgba(255, 255, 255, 0.05) !important;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
}

.bg-white:hover:not(button) {
    background: rgba(255, 255, 255, 0.08) !important;
    border-color: rgba(255, 255, 255, 0.2) !important;
}

/* Сірі фони → темні */
.bg-gray-50,
.bg-gray-100,
.bg-gray-200 {
    background: rgba(255, 255, 255, 0.05) !important;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
}

/* Великі картки з тінями */
.rounded-3xl.shadow-2xl,
.rounded-2xl.shadow-2xl {
    background: rgba(255, 255, 255, 0.05) !important;
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
}

/* Малі блоки */
.rounded-2xl,
.space-y-6 > div {
}

/* Hover ефекти для карток товарів */
.product-card-modern:hover,
.rounded-3xl:hover,
.rounded-2xl:hover {
    background: rgba(255, 255, 255, 0.08) !important;
}

/* ========== ТЕКСТ І ТИПОГРАФІЯ ========== */

/* Заголовки */
h1, h2, h3, h4, h5, h6 {
    color: #ffffff !important;
}

/* Темний текст → білий */
.text-gray-900:not(.bg-gradient-to-r *),
.text-gray-800:not(.bg-gradient-to-r *),
.text-gray-700:not(.bg-gradient-to-r *),
.text-gray-600:not(.bg-gradient-to-r *) {
    color: #ffffff !important;
}

/* Параграфи і span */
p:not(.current-price):not(.old-price):not([class*="bg-"]),
span:not(.current-price):not(.old-price):not([class*="bg-"]) {
    color: rgba(255, 255, 255, 0.9) !important;
}

/* Опис товару */
.prose,
.prose p,
.prose li,
.prose span {
    color: rgba(255, 255, 255, 0.9) !important;
}

/* ========== ФОРМИ І INPUT ========== */

/* Всі input fields */
input[type="text"],
input[type="email"],
input[type="password"],
input[type="number"],
input[type="search"],
select,
textarea {
    background: rgba(255, 255, 255, 0.05) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    color: #ffffff !important;
}

input::placeholder,
textarea::placeholder {
    color: rgba(255, 255, 255, 0.5) !important;
}

/* Select options */
select option {
    background: #1a1a2e !important;
    color: #ffffff !important;
}

/* Input для кількості товару */
.flex.items-center.gap-4 input {
    background: rgba(255, 255, 255, 0.05) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    color: #ffffff !important;
}

/* ========== DROPDOWN МЕНЮ ========== */

.dropdown-menu,
[role="menu"],
.absolute.right-0.mt-2 {
    background: rgba(26, 26, 46, 0.95) !important;
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
}

.dropdown-menu a,
[role="menu"] a,
.absolute.right-0.mt-2 a {
    color: rgba(255, 255, 255, 0.9) !important;
}

.dropdown-menu a:hover,
[role="menu"] a:hover,
.absolute.right-0.mt-2 a:hover {
    background: rgba(102, 126, 234, 0.3) !important;
}

/* ========== ТАБЛИЦІ (АДМІН ПАНЕЛЬ) ========== */

table {
    background: transparent !important;
}

thead {
    background: rgba(102, 126, 234, 0.2) !important;
}

tbody tr {
    background: rgba(255, 255, 255, 0.02) !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
}

tbody tr:hover {
    background: rgba(255, 255, 255, 0.05) !important;
}

th {
    color: #ffffff !important;
}

td {
    color: rgba(255, 255, 255, 0.9) !important;
}

/* ========== НАВІГАЦІЯ І BREADCRUMBS ========== */

.breadcrumb,
nav[aria-label="Breadcrumb"] {
    color: rgba(255, 255, 255, 0.7) !important;
}

.breadcrumb a {
    color: #a78bfa !important;
}

/* ========== BADGES І КАТЕГОРІЇ ========== */

.inline-flex.items-center,
.rounded-full.px-4 {
    background: rgba(102, 126, 234, 0.2) !important;
    color: #a78bfa !important;
}

/* ========== РЕЙТИНГ ========== */

.text-yellow-400 {
    color: #fbbf24 !important;
}

/* ========== ЦІНИ ========== */

/* Актуальна ціна - градієнт */
.text-4xl.font-black,
.text-5xl.font-black {
    background: linear-gradient(135deg, #a78bfa 0%, #ec4899 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Стара ціна */
.line-through {
    color: rgba(255, 255, 255, 0.4) !important;
}

/* ========== СТАТУСИ ========== */

/* В наявності */
.bg-green-50 {
    background: rgba(34, 197, 94, 0.1) !important;
    border: 1px solid rgba(34, 197, 94, 0.2) !important;
}

.text-green-600 {
    color: #22c55e !important;
}

/* Доставка */
.bg-blue-50 {
    background: rgba(59, 130, 246, 0.1) !important;
    border: 1px solid rgba(59, 130, 246, 0.2) !important;
}

.text-blue-600 {
    color: #3b82f6 !important;
}

/* ========== ХАРАКТЕРИСТИКИ ТОВАРУ ========== */

.grid.grid-cols-2.gap-4 > div {
    background: rgba(255, 255, 255, 0.03) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
}

.text-purple-400 {
    color: #c084fc !important;
}

/* ========== ГАЛЕРЕЯ ЗОБРАЖЕНЬ ========== */

.grid.grid-cols-4.gap-3 img {
    border: 2px solid rgba(255, 255, 255, 0.1) !important;
    border-radius: 12px;
}

.grid.grid-cols-4.gap-3 img:hover {
    border-color: rgba(102, 126, 234, 0.5) !important;
}

/* ========== РЕКОМЕНДОВАНІ ТОВАРИ ========== */

.mt-16 .rounded-3xl {
    background: rgba(255, 255, 255, 0.05) !important;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
}
</style>
    <style>
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); }
            50% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.8); }
        }
        
        .gradient-bg {
            background: linear-gradient(-45deg, #667eea 0%, #764ba2 25%, #f093fb 50%, #4facfe 75%, #00f2fe 100%);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }
        
        .float-animation {
            animation: float 3s ease-in-out infinite;
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .card-hover:hover {
            transform: translateY(-8px) scale(1.02);
        }
        
        .btn-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            transition: all 0.3s ease;
        }
        
        .btn-gradient:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-blue-50 to-purple-50 min-h-screen">
    
    <!-- Топ бар -->
    <div class="gradient-bg text-white text-sm py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-6">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        vadimchubar.ios@gmail.com
                    </span>
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                        </svg>
                        +380 50 157 11 67
                    </span>
                </div>
                <span class="hidden md:block">🚚 Безкоштовна доставка від 1000 грн</span>
            </div>
        </div>
    </div>
    
    <!-- Навігація -->
    <nav class="bg-white/80 backdrop-blur-lg shadow-xl sticky top-0 z-50 border-b border-purple-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <!-- Логотип -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-purple-600 to-blue-600 rounded-2xl blur opacity-75 group-hover:opacity-100 transition"></div>
                            <div class="relative bg-gradient-to-br from-purple-600 to-blue-600 p-3 rounded-2xl group-hover:scale-110 transition duration-300">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                            </div>
                        </div>
                        <div>
                            <span class="text-2xl font-black bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                                AutoParts
                            </span>
                            <p class="text-xs text-gray-500 font-semibold">Premium Quality</p>
                        </div>
                    </a>
                    
                    <!-- Навігація -->
                    <div class="hidden md:flex ml-10 space-x-2">
                        <a href="{{ route('home') }}" class="px-4 py-2 rounded-xl font-semibold transition {{ request()->routeIs('home') ? 'bg-gradient-to-r from-purple-600 to-blue-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gradient-to-r hover:from-purple-600 hover:to-blue-600 hover:text-white hover:shadow-lg' }}">
                            Головна
                        </a>
                        <a href="{{ route('products.index') }}" class="px-4 py-2 rounded-xl font-semibold transition {{ request()->routeIs('products.*') ? 'bg-gradient-to-r from-purple-600 to-blue-600 text-white shadow-lg' : 'text-gray-700 hover:bg-gradient-to-r hover:from-purple-600 hover:to-blue-600 hover:text-white hover:shadow-lg' }}">
                            Каталог
                        </a>
                    </div>
                </div>
                
                <!-- Права частина -->
                <div class="flex items-center space-x-3">
                    <!-- Кошик -->
                    <a href="{{ route('cart.index') }}" class="relative p-3 rounded-xl hover:bg-gradient-to-r hover:from-purple-600 hover:to-blue-600 hover:text-white hover:shadow-lg transition group">
                        <svg class="w-6 h-6 text-gray-700 group-hover:text-purple-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        @if(session('cart_count', 0) > 0)
                            <span class="cart-count absolute -top-1 -right-1 bg-gradient-to-r from-pink-500 to-purple-600 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center shadow-lg animate-pulse">
                                {{ session('cart_count', 0) }}
                            </span>
                        @endif
                    </a>
                    
                        @auth
                        <!-- Обране -->
                        <a href="{{ route('wishlist.index') }}" class="relative p-3 rounded-xl hover:bg-gradient-to-r hover:from-purple-600 hover:to-blue-600 hover:text-white hover:shadow-lg transition group">
                            <svg class="w-6 h-6 text-gray-700 group-hover:text-pink-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                            @if(session('wishlist_count', 0) > 0)
                                <span class="wishlist-count absolute -top-1 -right-1 bg-gradient-to-r from-pink-500 to-red-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center shadow-lg">
                                    {{ session('wishlist_count', 0) }}
                                </span>
                            @endif
                        </a>
                        
                        <!-- Користувач -->
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center space-x-2 px-4 py-2 rounded-xl hover:bg-gradient-to-r hover:from-purple-600 hover:to-blue-600 hover:text-white hover:shadow-lg transition">
                                <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold shadow-lg">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="hidden md:block font-semibold text-gray-700">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>
                            
                            <div x-show="open" @click.away="open = false" 
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute right-0 mt-2 w-64 bg-white/90 backdrop-blur-xl rounded-2xl shadow-2xl py-2 border border-purple-100">
                                @if(Auth::user()->isAdmin())
                                    <a href="{{ route('admin.products.index') }}" class="flex items-center px-4 py-3 hover:bg-gradient-to-r hover:from-purple-600 hover:to-blue-600 hover:text-white hover:shadow-lg transition">
                                        <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-blue-600 rounded-xl flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">Адмін-панель</p>
                                            <p class="text-xs text-gray-500">Керування сайтом</p>
                                        </div>
                                    </a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 hover:bg-gradient-to-r hover:from-purple-50 hover:to-blue-50 transition">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center mr-3">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-gray-900">Профіль</p>
                                        <p class="text-xs text-gray-500">Налаштування</p>
                                    </div>
                                </a>
                                <hr class="my-2 border-gray-200">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-3 hover:bg-gradient-to-r hover:from-purple-600 hover:to-blue-600 hover:text-white hover:shadow-lg transition">
                                        <div class="w-10 h-10 bg-white/10 rounded-xl flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="font-semibold text-gray-900">Вийти</p>
                                            <p class="text-xs text-gray-500">До зустрічі!</p>
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 text-gray-700 font-semibold hover:text-purple-600 transition">
                            Вхід
                        </a>
                        <a href="{{ route('register') }}" class="px-6 py-2.5 bg-gradient-to-r from-purple-600 to-blue-600 text-white rounded-xl font-semibold shadow-lg hover:shadow-xl transform hover:scale-105 transition">
                            Реєстрація
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>
    
    <!-- Повідомлення -->
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
            <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 p-5 rounded-2xl shadow-xl flex items-center justify-between backdrop-blur-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <p class="ml-4 font-semibold text-green-800">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-green-600 hover:text-green-800 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif
    
    @if(session('error'))
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6" x-data="{ show: true }" x-show="show">
            <div class="bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 p-5 rounded-2xl shadow-xl flex items-center justify-between backdrop-blur-sm">
                <div class="flex items-center">
                    <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-red-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <p class="ml-4 font-semibold text-red-800">{{ session('error') }}</p>
                </div>
                <button @click="show = false" class="text-red-600 hover:text-red-800 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif
    
    <!-- Контент -->
    <main>
        @yield('content')
    </main>
    
    <!-- Футер -->
    <footer class="relative mt-20 bg-gradient-to-br from-gray-900 via-purple-900 to-blue-900 text-white overflow-hidden">
        <!-- Декоративні елементи -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="bg-gradient-to-br from-purple-500 to-blue-600 p-3 rounded-2xl shadow-2xl">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                            </svg>
                        </div>
                        <span class="text-2xl font-black">AutoParts</span>
                    </div>
                    <p class="text-gray-300 leading-relaxed">
                        Ваш надійний партнер у світі автозапчастин. Якість, швидкість, професіоналізм.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-6 bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">Навігація</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition flex items-center group">
                            <span class="mr-2 group-hover:mr-3 transition-all">→</span> Головна
                        </a></li>
                        <li><a href="{{ route('products.index') }}" class="text-gray-300 hover:text-white transition flex items-center group">
                            <span class="mr-2 group-hover:mr-3 transition-all">→</span> Каталог
                        </a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-6 bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">Категорії</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-300 hover:text-white transition flex items-center group">
                            <span class="mr-2 group-hover:mr-3 transition-all">→</span> Акумулятори
                        </a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition flex items-center group">
                            <span class="mr-2 group-hover:mr-3 transition-all">→</span> Лампочки
                        </a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition flex items-center group">
                            <span class="mr-2 group-hover:mr-3 transition-all">→</span> Електрика
                        </a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-6 bg-gradient-to-r from-purple-400 to-blue-400 bg-clip-text text-transparent">Контакти</h3>
                    <ul class="space-y-4">
                        <li class="flex items-center text-gray-300">
                            <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-blue-600 rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                            </div>
                            vadimchubar.ios@gmail.com
                        </li>
                        <li class="flex items-center text-gray-300">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center mr-3">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                </svg>
                            </div>
                            +380 50 157 11 67
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-white/10 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400">&copy; 2025 AutoParts. Всі права захищені.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="https://www.facebook.com/profile.php?id=100008687257373&locale=ru_RU" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center transition backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <a href="https://github.com/kybiik/Autoparts" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center transition backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                    </a>
                    <a href="https://www.instagram.com/kybik._bjj/" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-xl flex items-center justify-center transition backdrop-blur-sm">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
    
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="{{ asset('js/modern-animations.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // ========== AJAX ДОДАВАННЯ В КОШИК ==========
    document.addEventListener('submit', function(e) {
        const form = e.target;
        
        // Перевіряємо чи це форма кошика або вішлисту
        if (!form.action.includes('/cart') && !form.action.includes('/wishlist')) return;
        
        const methodInput = form.querySelector('input[name="_method"]');
        
        // ДОДАВАННЯ (POST без _method)
        if (form.method.toLowerCase() === 'post' && !methodInput) {
            e.preventDefault();
            
            const formData = new FormData(form);
            const button = form.querySelector('button[type="submit"]');
            const originalText = button.innerHTML;
            
            button.disabled = true;
            button.innerHTML = '⏳ Додаємо...';
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Якщо це вішлист — не змінюємо текст кнопки, змінюємо тільки стан/колір
                    if (form.action.includes('/wishlist')) {
                        if (data.count !== undefined) updateWishlistCount(data.count);
                        // Якщо отримали id/delete_url — переключаємо форму на DELETE
                        try {
                            const btn = form.querySelector('button[type="submit"], button');
                            if (data.delete_url) {
                                form.action = data.delete_url;
                                // додаємо _method=DELETE
                                let methodInput = form.querySelector('input[name="_method"]');
                                if (!methodInput) {
                                    methodInput = document.createElement('input');
                                    methodInput.type = 'hidden';
                                    methodInput.name = '_method';
                                    form.appendChild(methodInput);
                                }
                                methodInput.value = 'DELETE';
                            }
                            if (btn) {
                                btn.classList.add('wishlist-active','pop');
                                setTimeout(() => btn.classList.remove('pop'), 380);
                                // Увімкнути кнопку знову
                                btn.disabled = false;
                            }

                            // Якщо сервер відповів, що товар вже в обраному — просто анімуємо сердечко і показуємо повідомлення
                            if (data.already) {
                                if (btn) {
                                    btn.classList.add('pop');
                                    setTimeout(() => btn.classList.remove('pop'), 380);
                                }
                                showToast('info', data.message || 'Товар вже в обраному');
                            }
                        } catch (err) {
                            console.error('Wishlist toggle error:', err);
                        }
                        // Якщо не було вже — показуємо стандартне повідомлення
                        if (!data.already) showToast('success', data.message || 'Додано до обраного!');
                    } else {
                        // Для кошика показуємо тимчасовий текст "Додано!"
                        button.innerHTML = '✅ Додано!';
                        updateCartCount();
                        showToast('success', data.message || 'Товар додано!');
                        setTimeout(() => {
                            button.innerHTML = originalText;
                            button.disabled = false;
                        }, 2000);
                    }
                    
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(error => {
                button.innerHTML = originalText;
                button.disabled = false;
                showToast('error', error.message || 'Помилка!');
            });
        }
        
// ВИДАЛЕННЯ (DELETE)
else if (methodInput && methodInput.value === 'DELETE') {
    e.preventDefault();
    
    const formData = new FormData(form);
    const cartItem = form.closest('.bg-white.rounded-3xl, .product-card-modern, [class*="rounded"]');
    const wishlistItem = form.closest('.wishlist-item');
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Якщо це видалення з вішлисту
            if (form.action.includes('/wishlist')) {
                if (wishlistItem) {
                    wishlistItem.style.transform = 'translateX(100%)';
                    wishlistItem.style.opacity = '0';
                    wishlistItem.style.transition = 'all 0.3s ease';
                    setTimeout(() => wishlistItem.remove(), 300);
                }
                if (data.count !== undefined) updateWishlistCount(data.count);
                // Якщо форма, що відправилася, знаходиться не в списку (наприклад на карточці товару), скасуємо DELETE і повернемо до store
                try {
                    const btn = form.querySelector('button[type="submit"], button');
                    if (form && data.add_url) {
                        form.action = data.add_url;
                        const methodInput = form.querySelector('input[name="_method"]');
                        if (methodInput) methodInput.remove();
                    }
                    if (btn) {
                        btn.classList.remove('wishlist-active');
                    }
                } catch (err) {
                    console.error('Wishlist revert error:', err);
                }

                showToast('success', data.message || 'Видалено з обраного!');
                // Якщо після видалення немає більше елементів — перезавантажимо, щоб показати порожній стан
                setTimeout(() => {
                    const remaining = document.querySelectorAll('.wishlist-item');
                    if (remaining.length === 0) location.reload();
                }, 350);
            } else {
                // Анімація видалення для кошика
                if (cartItem) {
                    cartItem.style.transform = 'translateX(100%)';
                    cartItem.style.opacity = '0';
                    cartItem.style.transition = 'all 0.3s ease';
                    
                    setTimeout(() => {
                        cartItem.remove();

                        // Перевіряємо чи залишись товари
                        const remainingItems = document.querySelectorAll('.lg\\:col-span-2 > div, [class*="cart-item"]');
                        if (remainingItems.length === 0) {
                            // Відобразимо порожній стан кошика без перезавантаження
                            renderEmptyCart();
                        } else {
                            // ✅ ВАЖЛИВО: Оновлюємо підсумок
                            updateCartSummary();
                            updateCartCount();
                        }
                    }, 300);
                }
                showToast('error', data.message || 'Видалено!');
            }
        } else {
            throw new Error(data.message);
        }
    })
    .catch(error => {
        showToast('error', error.message || 'Помилка видалення!');
        setTimeout(() => location.reload(), 1000);
    });
}
        
        // ОНОВЛЕННЯ КІЛЬКОСТІ (PATCH)
        else if (methodInput && methodInput.value === 'PATCH') {
            e.preventDefault();
            
            const formData = new FormData(form);
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    updateCartSummary();
                    updateCartCount();
                    showToast('success', data.message || 'Оновлено!');
                } else {
                    throw new Error(data.message);
                }
            })
            .catch(error => {
                showToast('error', error.message || 'Помилка!');
                // не перезавантажуємо сторінку — просто повідомляємо користувача
            });
        }
    });
    
    // Обробка кнопок + і - для зміни кількості
    document.addEventListener('click', function(e) {
        const button = e.target.closest('button[type="button"]');
        if (!button) return;
        
        const form = button.closest('form');
        if (!form || !form.action.includes('/cart')) return;
        
        const quantityInput = form.querySelector('input[name="quantity"]');
        if (!quantityInput) return;
        
        const methodInput = form.querySelector('input[name="_method"]');
        if (!methodInput || methodInput.value !== 'PATCH') return;
        
        // Чекаємо поки input оновиться
        setTimeout(() => {
            form.dispatchEvent(new Event('submit', { bubbles: true, cancelable: true }));
        }, 100);
    });
});

// Оновлення лічильника
function updateCartCount() {
    fetch('{{ route("cart.count") }}', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        const badges = document.querySelectorAll('.cart-count');
        badges.forEach(badge => {
            badge.textContent = data.count;
            badge.classList.add('scale-125');
            setTimeout(() => badge.classList.remove('scale-125'), 300);
        });
    })
    .catch(error => console.error('Cart count error:', error));
}

// Оновлення лічильника обраного
function updateWishlistCount(count) {
    try {
        const badges = document.querySelectorAll('.wishlist-count');
        badges.forEach(badge => {
            badge.textContent = count;
            badge.classList.add('scale-125');
            setTimeout(() => badge.classList.remove('scale-125'), 300);
        });

        const wishlistPageCounts = document.querySelectorAll('.wishlist-items-count');
        wishlistPageCounts.forEach(el => {
            // Текст на сторінці: "X товарів" або "X товар"
            const n = parseInt(count, 10) || 0;
            el.textContent = n + ' ' + (n === 1 ? 'товар' : 'товарів');
        });
    } catch (err) {
        console.error('Wishlist count update error:', err);
    }
}

// Оновлення підсумку
// Оновлення підсумку кошика
function updateCartSummary() {
    fetch('/cart/summary', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        // Кількість товарів
        const itemsCountElements = document.querySelectorAll('.items-count, [class*="Товарів"]');
        itemsCountElements.forEach(el => {
            if (el.textContent.includes('Товарів')) {
                el.textContent = `Товарів (${data.items_count} шт):`;
            } else {
                el.textContent = data.items_count;
            }
        });

        // Обробка кліка на "Безпечна оплата"
        document.addEventListener('click', function(e) {
            const btn = e.target.closest('#secure-pay-btn');
            if (!btn) return;
            try {
                btn.disabled = true;
                showToast('success', 'Дякуємо за покупку!');
                btn.classList.add('scale-95');
                setTimeout(() => {
                    btn.classList.remove('scale-95');
                    btn.disabled = false;
                }, 900);
            } catch (err) {
                console.error('Secure pay click error:', err);
            }
        });
        
        // Підсумкова ціна
        const totalPriceElements = document.querySelectorAll('.total-price, [class*="До сплати"]');
        totalPriceElements.forEach(el => {
            const priceText = data.total_formatted + ' ₴';
            if (el.textContent.includes('До сплати')) {
                el.innerHTML = `До сплати: <span class="text-4xl font-black bg-gradient-to-r from-purple-400 to-pink-600 bg-clip-text text-transparent">${priceText}</span>`;
            } else {
                el.textContent = priceText;
            }
        });

        // Оновлюємо підсумок по кожному рядку (subtotal) якщо сервер повернув деталі
        if (data.items && Array.isArray(data.items)) {
            data.items.forEach(item => {
                try {
                    const el = document.querySelector(`.item-subtotal[data-cart-id="${item.id}"]`);
                    if (el) el.textContent = item.total_formatted + ' ₴';
                } catch (err) {
                    console.error('Error updating item subtotal for id', item.id, err);
                }
            });
        }

        console.log('Cart summary updated:', data);
    })
    .catch(error => {
        console.error('Summary update error:', error);
        // Якщо помилка - показуємо повідомлення, без перезавантаження
        showToast('error', 'Не вдалося оновити підсумок');
    });
}

// Рендер порожнього кошика на клієнті (замінює контент кошика)
function renderEmptyCart() {
    try {
        const container = document.querySelector('.max-w-7xl.mx-auto.px-4.sm\\:px-6.lg\\:px-8.py-12');
        if (!container) return;

        const emptyHtml = `
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
        `;

        container.innerHTML = emptyHtml;
        // Оновимо лічильники
        updateCartCount();
        updateCartSummary();
    } catch (err) {
        console.error('renderEmptyCart error:', err);
    }
}

// Оптимістичне оновлення рядків кошика
function parsePrice(value) {
    if (!value) return 0;
    const num = String(value).replace(/[^0-9\-\.]/g, '');
    return parseFloat(num) || 0;
}

function formatPrice(value) {
    try {
        return new Intl.NumberFormat('uk-UA').format(Math.round(value));
    } catch (e) {
        return String(Math.round(value));
    }
}

function optimisticUpdateRow(cartId, unitPrice, qty) {
    try {
        const subtotalEl = document.querySelector(`.item-subtotal[data-cart-id="${cartId}"]`);
        const prevSubtotal = subtotalEl ? parsePrice(subtotalEl.textContent) : 0;
        const newSubtotal = unitPrice * Number(qty);
        if (subtotalEl) subtotalEl.textContent = formatPrice(newSubtotal) + ' ₴';

        // Оновлюємо загальні підсумки (додаємо різницю)
        const delta = newSubtotal - prevSubtotal;
        const totalEls = document.querySelectorAll('.total-price');
        totalEls.forEach(el => {
            // Якщо елемент містить внутрішній span (До сплати)
            const innerSpan = el.querySelector && el.querySelector('span');
            if (innerSpan) {
                const cur = parsePrice(innerSpan.textContent);
                innerSpan.textContent = formatPrice(cur + delta) + ' ₴';
            } else {
                const cur = parsePrice(el.textContent);
                el.textContent = formatPrice(cur + delta) + ' ₴';
            }
        });

        // Оновимо лічильник товарів, підсумовуючи всі input[name="quantity"] на сторінці
        const totalQty = Array.from(document.querySelectorAll('input[name="quantity"]')).reduce((s, i) => s + (Number(i.value) || 0), 0);
        const itemsCountElements = document.querySelectorAll('.items-count');
        itemsCountElements.forEach(el => {
            el.textContent = `Товарів (${totalQty} шт):`;
        });
    } catch (err) {
        console.error('optimisticUpdateRow error:', err);
    }
}

function handleCartQtyClick(e, btn, delta) {
    e.stopPropagation();
    try {
        const form = btn.closest('form');
        if (!form) return;
        const input = form.querySelector('input[name="quantity"]');
        if (!input) return;

        // Обновлюємо значення локально
        let current = Number(input.value) || 0;
        const min = Number(input.getAttribute('min') || 1);
        const max = Number(input.getAttribute('max') || 999999);
        current = Math.max(min, Math.min(max, current + Number(delta)));
        input.value = current;

        // Оптимістичне оновлення subtotal і totals
        const cartItem = btn.closest('[data-cart-id]');
        const cartId = cartItem ? cartItem.getAttribute('data-cart-id') : null;
        const unitPrice = cartItem ? Number(cartItem.getAttribute('data-unit-price') || 0) : 0;
        if (cartId) optimisticUpdateRow(cartId, unitPrice, current);

        // Викликаємо сабміт форми для синхронізації з сервером
        form.dispatchEvent(new Event('submit', { bubbles: true, cancelable: true }));
    } catch (err) {
        console.error('handleCartQtyClick error:', err);
    }
}

function handleCartQtyInputChange(e, input) {
    e.stopPropagation();
    try {
        const form = input.closest('form');
        if (!form) return;
        let value = Number(input.value) || 1;
        const min = Number(input.getAttribute('min') || 1);
        const max = Number(input.getAttribute('max') || 999999);
        value = Math.max(min, Math.min(max, value));
        input.value = value;

        const cartItem = input.closest('[data-cart-id]');
        const cartId = cartItem ? cartItem.getAttribute('data-cart-id') : null;
        const unitPrice = cartItem ? Number(cartItem.getAttribute('data-unit-price') || 0) : 0;
        if (cartId) optimisticUpdateRow(cartId, unitPrice, value);

        form.dispatchEvent(new Event('submit', { bubbles: true, cancelable: true }));
    } catch (err) {
        console.error('handleCartQtyInputChange error:', err);
    }
}

// Toast повідомлення
function showToast(type, message) {
    const toast = document.createElement('div');
    toast.className = `fixed top-24 right-4 z-50 px-6 py-4 rounded-2xl shadow-2xl transform transition-all duration-300 translate-x-full ${
        type === 'success' ? 'bg-green-600' : 'bg-red-600'
    } text-white font-bold`;
    toast.innerHTML = `
        <div class="flex items-center space-x-3">
            <span class="text-2xl">${type === 'success' ? '✅' : '❌'}</span>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(toast);
    setTimeout(() => toast.classList.remove('translate-x-full'), 100);
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
</script>
    <style>
    /* Wishlist button styles */
    .wishlist-btn {
        padding: .6rem;
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.06);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: transform .18s ease, background .18s ease, color .18s ease;
        color: #fff;
    }

    .wishlist-btn:hover { transform: scale(1.08); }

    .wishlist-btn .heart-icon { transition: transform .18s ease, fill .18s ease, color .18s ease; }

    .wishlist-btn.wishlist-active {
        background: linear-gradient(135deg,#ff7aa2 0%,#ff3b3b 100%);
        color: #fff;
        box-shadow: 0 6px 18px rgba(255,59,59,0.2);
        transform: scale(1.04);
    }

    .wishlist-btn.wishlist-active .heart-icon { transform: scale(1.08); fill: currentColor; }

    @keyframes heart-pop {
        0% { transform: scale(.85); }
        50% { transform: scale(1.15); }
        100% { transform: scale(1); }
    }

    .wishlist-btn.pop {
        animation: heart-pop .36s ease;
    }
    </style>