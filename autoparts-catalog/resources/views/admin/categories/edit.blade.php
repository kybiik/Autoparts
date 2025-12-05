@extends('layouts.app')

@section('title', 'Редагувати категорію - Адмін')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center mb-6">
        <a href="{{ route('admin.categories.index') }}" class="text-blue-600 hover:text-blue-700 mr-4">
            ← Назад
        </a>
        <h1 class="text-3xl font-bold">Редагувати категорію</h1>
    </div>
    
    <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
        @csrf
        @method('PATCH')
        
        <div class="space-y-6">
            <!-- Назва -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Назва категорії *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Опис -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Опис</label>
                <textarea name="description" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $category->description) }}</textarea>
                <p class="text-gray-500 text-xs mt-1">Короткий опис категорії</p>
            </div>
            
            <!-- Порядок сортування -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Порядок сортування *</label>
                <input type="number" name="order" value="{{ old('order', $category->order) }}" required
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('order') border-red-500 @enderror">
                <p class="text-gray-500 text-xs mt-1">Чим менше число - тим вище в списку</p>
                @error('order')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Зображення -->
            <div>
                @if($category->image)
                    <div class="mb-4">
                        <p class="text-sm font-medium text-gray-700 mb-2">Поточне зображення:</p>
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-32 h-32 object-contain border rounded">
                    </div>
                @endif
                
                <label class="block text-sm font-medium text-gray-700 mb-2">Нове зображення категорії</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-gray-500 text-xs mt-1">Максимум 2MB, JPG, PNG, GIF</p>
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Активна -->
            <div>
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                    <span class="ml-2 text-sm text-gray-700">Активна категорія</span>
                </label>
            </div>
        </div>
        
        <!-- Кнопки -->
        <div class="flex gap-4 mt-8">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                Зберегти зміни
            </button>
            <a href="{{ route('admin.categories.index') }}" class="bg-gray-200 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-300">
                Скасувати
            </a>
        </div>
    </form>
</div>
@endsection
