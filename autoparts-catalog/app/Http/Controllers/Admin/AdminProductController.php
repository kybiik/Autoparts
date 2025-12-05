<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\AdminLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{

    public function index(Request $request)
    {
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->paginate(15);
        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::active()->ordered()->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'specifications' => 'nullable|string',
        'sku' => 'required|string|unique:products,sku',
        'price' => 'required|numeric|min:0',
        'old_price' => 'nullable|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'manufacturer' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',
        'warranty' => 'nullable|string|max:255',
        'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // ✅ ОБРОБКА CHECKBOX
    $validated['is_featured'] = $request->has('is_featured');
    $validated['is_active'] = $request->has('is_active');
    
    $validated['slug'] = Str::slug($validated['name']);

    if ($request->hasFile('main_image')) {
        $validated['main_image'] = $request->file('main_image')->store('products', 'public');
    }

    $product = Product::create($validated);

    if ($request->hasFile('additional_images')) {
        foreach ($request->file('additional_images') as $index => $image) {
            $path = $image->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'order' => $index,
            ]);
        }
    }

    AdminLog::create([
        'user_id' => auth()->id(),
        'action' => 'create',
        'model' => 'Product',
        'model_id' => $product->id,
        'new_values' => $product->toArray(),
        'ip_address' => $request->ip(),
    ]);

    return redirect()->route('admin.products.index')
        ->with('success', 'Товар успішно створено!');
}

    public function edit(Product $product)
    {
        $categories = Category::active()->ordered()->get();
        $product->load('images');
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
{
    $oldValues = $product->toArray();

    $validated = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'specifications' => 'nullable|string',
        'sku' => 'required|string|unique:products,sku,' . $product->id,
        'price' => 'required|numeric|min:0',
        'old_price' => 'nullable|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'manufacturer' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',
        'warranty' => 'nullable|string|max:255',
        'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // ✅ ВИПРАВЛЕННЯ: Обробка checkbox
    $validated['is_featured'] = $request->has('is_featured');
    $validated['is_active'] = $request->has('is_active');
    
    $validated['slug'] = Str::slug($validated['name']);

    if ($request->hasFile('main_image')) {
        if ($product->main_image) {
            Storage::disk('public')->delete($product->main_image);
        }
        $validated['main_image'] = $request->file('main_image')->store('products', 'public');
    }

    $product->update($validated);

    if ($request->hasFile('additional_images')) {
        foreach ($request->file('additional_images') as $index => $image) {
            $path = $image->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'order' => $product->images()->max('order') + $index + 1,
            ]);
        }
    }

    AdminLog::create([
        'user_id' => auth()->id(),
        'action' => 'update',
        'model' => 'Product',
        'model_id' => $product->id,
        'old_values' => $oldValues,
        'new_values' => $product->fresh()->toArray(),
        'ip_address' => $request->ip(),
    ]);

    return redirect()->route('admin.products.index')
        ->with('success', 'Товар успішно оновлено!');
}

    public function destroy(Product $product)
    {
        $oldValues = $product->toArray();

        if ($product->main_image) {
            Storage::disk('public')->delete($product->main_image);
        }

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        AdminLog::create([
           'user_id' => auth()->id(),
           'action' => 'delete',
           'model' => 'Product',
           'model_id' => $product->id,
           'old_values' => $oldValues,
           'ip_address' => request()->ip(),
        ]);

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар успішно видалено!');
    }

    public function deleteImage(ProductImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Зображення видалено!');
    }
}