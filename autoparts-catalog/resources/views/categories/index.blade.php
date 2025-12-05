@extends('layouts.app')

@section('title', 'Управління категоріями - Адмін')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Управління категоріями</h1>
        <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
            + Додати категорію
        </a>
    </div>
    
    <!-- Навігація -->
    <div class="bg-white rounded-lg shadow mb-6">
        <div class="flex border-b">
            <a href="{{ route('admin.products.index') }}" class="px-6 py-3 text-gray-600 hover:text-blue-600">
                Товари
            </a>
            <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 border-b-2 border-blue-600 text-blue-600 font-semibold">
                Категорії
            </a>
        </div>
    </div>
    
    <!-- Таблиця -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Назва</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Порядок</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Статус</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Дії</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($categories as $category)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $category->id }}</td>
                        <td class="px-6 py-4 text-sm font-medium">{{ $category->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $category->slug }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $category->order }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($category->is_active)
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Активна</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Неактивна</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-900 mr-3">Редагувати</a>
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Видалити?')">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="mt-6">
        {{ $categories->links() }}
    </div>
</div>
@endsection