@extends('layouts.app')

@section('title', 'Додати товар - Адмін')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.products.index') }}" class="text-blue-600 hover:text-blue-700 mr-4">
            ← Назад
        </a>
        <h1 class="text-3xl font-bold">Додати товар</h1>
    </div>
    
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
        @csrf
        
        <!-- Основна інформація -->
        <div class="mb-6">
            <h2 class="text-xl font-bold mb-4">Основна інформація</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Назва -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Назва товару *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Категорія -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Категорія *</label>
                    <select name="category_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror">
                        <option value="">Оберіть категорію</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Артикул -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Артикул (SKU) *</label>
                    <input type="text" name="sku" value="{{ old('sku') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('sku') border-red-500 @enderror">
                    @error('sku')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Опис -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Опис *</label>
                    <textarea name="description" rows="4" required
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Технічні характеристики -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Технічні характеристики</label>
                    <textarea name="specifications" rows="3" placeholder="Введіть характеристики (кожна з нового рядка)"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('specifications') }}</textarea>
                </div>
            </div>
        </div>
        
        <!-- Ціна та склад -->
        <div class="mb-6">
            <h2 class="text-xl font-bold mb-4">Ціна та склад</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ціна (грн) *</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('price') border-red-500 @enderror">
                    @error('price')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Стара ціна (грн)</label>
                    <input type="number" step="0.01" name="old_price" value="{{ old('old_price') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Кількість на складі *</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('stock') border-red-500 @enderror">
                    @error('stock')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
        
        <!-- Додаткова інформація -->
        <div class="mb-6">
            <h2 class="text-xl font-bold mb-4">Додаткова інформація</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Виробник</label>
                    <input type="text" name="manufacturer" value="{{ old('manufacturer') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Країна виробництва</label>
                    <input type="text" name="country" value="{{ old('country') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Гарантія</label>
                    <input type="text" name="warranty" value="{{ old('warranty') }}" placeholder="Наприклад: 12 місяців"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
        </div>
        
        <!-- Зображення -->
        <div class="mb-6">
            <h2 class="text-xl font-bold mb-4">Зображення</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Головне зображення</label>
                    <input type="file" name="main_image" accept="image/*"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-gray-500 text-xs mt-1">Максимум 2MB, JPG, PNG, GIF</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Додаткові зображення</label>
                    <input type="file" name="additional_images[]" accept="image/*" multiple
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <p class="text-gray-500 text-xs mt-1">Можна обрати декілька файлів</p>
                </div>
            </div>
        </div>
        
        <!-- Налаштування -->
        <div class="mb-6">
            <h2 class="text-xl font-bold mb-4">Налаштування</h2>
            
            <div class="space-y-3">
                <label class="flex items-center">
                    <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Рекомендований товар</span>
                </label>
                
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Активний товар</span>
                </label>
            </div>
        </div>
        
        <!-- Кнопки -->
        <div class="flex gap-4">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                Створити товар
            </button>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-300">
                Скасувати
            </a>
        </div>
    </form>
</div>
@endsection
