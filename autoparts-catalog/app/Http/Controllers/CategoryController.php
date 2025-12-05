<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)
            ->active()
            ->firstOrFail();

        $products = $category->products()
            ->active()
            ->paginate(12);

        $categories = Category::active()->ordered()->get();

        return view('categories.show', compact('category', 'products', 'categories'));
    }
}