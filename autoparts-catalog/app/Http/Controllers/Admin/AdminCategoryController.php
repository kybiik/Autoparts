<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\AdminLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminCategoryController extends Controller
{

    public function index()
    {
        $categories = Category::orderBy('order')->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category = Category::create($validated);

        AdminLog::create([
            'user_id' => auth()->id(),
            'action' => 'create',
            'model' => 'Category',
            'model_id' => $category->id,
            'new_values' => $category->toArray(),
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Категорію успішно створено!');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $oldValues = $category->toArray();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }

        $category->update($validated);

        AdminLog::create([
            'user_id' => auth()->id(),
            'action' => 'update',
            'model' => 'Category',
            'model_id' => $category->id,
            'old_values' => $oldValues,
            'new_values' => $category->toArray(),
            'ip_address' => $request->ip(),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Категорію успішно оновлено!');
    }

    public function destroy(Category $category)
    {
        $oldValues = $category->toArray();

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        AdminLog::create([
            'user_id' => auth()->id(),
            'action' => 'delete',
            'model' => 'Category',
            'model_id' => $category->id,
            'old_values' => $oldValues,
            'ip_address' => request()->ip(),
        ]);

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Категорію успішно видалено!');
    }
}