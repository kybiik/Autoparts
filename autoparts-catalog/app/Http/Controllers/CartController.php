<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = $this->getCartItems();
        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
    ]);

    $product = Product::findOrFail($request->product_id);

    if ($product->stock < $request->quantity) {
        return back()->with('error', 'Недостатньо товару на складі');
    }

    $data = [
        'product_id' => $product->id,
        'quantity' => $request->quantity,
    ];

    if (auth()->check()) {
        $data['user_id'] = auth()->id();
        
        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($product->stock < $newQuantity) {
                return back()->with('error', 'Недостатньо товару на складі');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create($data);
        }
    } else {
        $data['session_id'] = Session::getId();
        
        $cartItem = CartItem::where('session_id', Session::getId())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $request->quantity;
            if ($product->stock < $newQuantity) {
                return back()->with('error', 'Недостатньо товару на складі');
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create($data);
        }
    }

        if (request()->wantsJson()) {
        return response()->json([
        'success' => true,
        'message' => 'Товар додано до кошика!'
        ]);
    }
    return back()->with('success', 'Товар додано до кошика!');
}

    public function update(Request $request, CartItem $cartItem)
{
    $request->validate([
        'quantity' => 'required|integer|min:1'
    ]);

    if (!$this->canAccessCartItem($cartItem)) {
        abort(403);
    }

    if ($cartItem->product->stock < $request->quantity) {
        if (request()->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => 'Недостатньо товару на складі'
            ], 400);
        }
        return back()->with('error', 'Недостатньо товару на складі');
    }

    $cartItem->update(['quantity' => $request->quantity]);

    if (request()->wantsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Кількість оновлено!'
        ]);
    }

    return back()->with('success', 'Кількість оновлено!');
}
    public function summary()
{
    $cartItems = $this->getCartItems();
    $total = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    return response()->json([
        'items_count' => $cartItems->sum('quantity'),
        'total' => $total,
        'total_formatted' => number_format($total, 0),
        'items' => $cartItems->map(function ($item) {
            return [
                'id' => $item->id,
                'total' => $item->product->price * $item->quantity,
                'total_formatted' => number_format($item->product->price * $item->quantity, 0),
            ];
        })
    ]);
}



    public function destroy(CartItem $cartItem)
{
    if (!$this->canAccessCartItem($cartItem)) {
        abort(403);
    }

    $cartItem->delete();

    $cartItems = $this->getCartItems();
    $total = $cartItems->sum(function ($item) {
        return $item->product->price * $item->quantity;
    });

    if (request()->wantsJson()) {
        return response()->json([
            'success' => true,
            'message' => 'Товар видалено з кошика!',
            'items_count' => $cartItems->sum('quantity'),
            'total' => $total,
            'total_formatted' => number_format($total, 0),
        ]);
    }

    return back()->with('success', 'Товар видалено з кошика!');
}

    public function clear()
    {
        if (auth()->check()) {
            CartItem::where('user_id', auth()->id())->delete();
        } else {
            CartItem::where('session_id', Session::getId())->delete();
        }

        return back()->with('success', 'Кошик очищено!');
    }

    private function getCartItems()
    {
        if (auth()->check()) {
            return CartItem::with('product')
                ->where('user_id', auth()->id())
                ->get();
        } else {
            return CartItem::with('product')
                ->where('session_id', Session::getId())
                ->get();
        }
    }

    private function canAccessCartItem(CartItem $cartItem)
    {
        if (auth()->check()) {
            return $cartItem->user_id === auth()->id();
        } else {
            return $cartItem->session_id === Session::getId();
        }
    }

    public function count()
    {
           $count = $this->getCartItems()->sum('quantity');
        return response()->json(['count' => $count]);
    }


    
}