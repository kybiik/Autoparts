<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Головна сторінка сайту
     */
    public function index()
    {
        // Рекомендовані товари
        $featuredProducts = Product::with('category')
            ->active()
            ->featured()
            ->inStock()
            ->limit(20)
            ->get();

        // Нові товари
        $newProducts = Product::with('category')
            ->active()
            ->inStock()
            ->latest()
            ->limit(8)
            ->get();

        // Популярні товари
        $popularProducts = Product::with('category')
            ->active()
            ->inStock()
            ->orderBy('views', 'desc')
            ->limit(8)
            ->get();

        // Категорії
        $categories = Category::active()->ordered()->get();

        return view('home', compact('featuredProducts', 'newProducts', 'popularProducts', 'categories'));
    }
}