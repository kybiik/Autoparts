<div class="bg-white text-slate-900 rounded-2xl shadow-sm hover:-translate-y-1 hover:shadow-2xl hover:shadow-amber-500/10 transition overflow-hidden group">
    <a href="{{ route('products.show', $product->slug) }}">
        <div class="aspect-[4/3] bg-slate-100 flex items-center justify-center overflow-hidden">
            <img src="{{ asset('storage/'.$product->main_image) }}"
                 alt="{{ $product->name }}"
                 class="w-full h-full object-contain group-hover:scale-105 transition duration-300">
        </div>
    </a>

    <div class="p-4 space-y-2">
        <div class="flex items-center justify-between gap-2">
            <h3 class="font-semibold text-lg line-clamp-1">{{ $product->name }}</h3>

            @if($product->hasDiscount())
                <span class="text-xs font-bold bg-amber-100 text-amber-700 px-2 py-1 rounded-full shrink-0">
                    -{{ $product->getDiscountPercentage() }}%
                </span>
            @endif
        </div>

        <p class="text-sm text-slate-600 line-clamp-2">{{ $product->description }}</p>

        <div class="flex items-end justify-between pt-2">
            <div>
                <div class="text-xl font-bold">
                    {{ number_format($product->price, 0, '.', ' ') }} ₴
                </div>
                @if($product->hasDiscount())
                    <div class="text-sm line-through text-slate-400">
                        {{ number_format($product->old_price,0,'.',' ') }} ₴
                    </div>
                @endif
            </div>

            <a href="{{ route('products.show', $product->slug) }}"
               class="px-3 py-2 rounded-lg bg-slate-900 text-white text-sm font-semibold hover:bg-amber-500 hover:text-slate-900 transition">
                Детальніше
            </a>
        </div>
    </div>
</div>
