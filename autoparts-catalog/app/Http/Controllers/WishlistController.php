<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function index()
    {
        // Перевірка чи користувач залогінений
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Спочатку увійдіть в акаунт');
        }

        $wishlistItems = Wishlist::with('product.category')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('wishlist.index', compact('wishlistItems'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Спочатку увійдіть в акаунт');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $exists = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($exists) {
            $count = Wishlist::where('user_id', auth()->id())->count();
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'already' => true,
                    'message' => 'Товар вже в обраному',
                    'count' => $count,
                ]);
            }

            return back()->with('info', 'Товар вже в списку бажань!');
        }


        $wishlist = Wishlist::create([
            'user_id'    => auth()->id(),
            'product_id' => $request->product_id,
        ]);

        $count = Wishlist::where('user_id', auth()->id())->count();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Додано до обраного!',
                'count' => $count,
                'id' => $wishlist->id,
                'delete_url' => route('wishlist.destroy', $wishlist->id),
            ]);
        }

        return back()->with('success', 'Додано до обраного!');
    }

    public function destroy($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Спочатку увійдіть в акаунт');
        }

        $wishlist = Wishlist::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (! $wishlist) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Товар не знайдено в обраному',
                ], 404);
            }

            return back()->with('error', 'Товар не знайдено в обраному');
        }

        $wishlist->delete();

        $count = Wishlist::where('user_id', auth()->id())->count();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Видалено з обраного!',
                'count' => $count,
                'add_url' => route('wishlist.store'),
            ]);
        }

        return back()->with('success', 'Видалено з обраного!');
    }
}
