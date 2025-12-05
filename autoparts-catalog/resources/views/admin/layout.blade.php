<div class="bg-slate-900 border border-slate-800 rounded-2xl overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-slate-950 text-slate-300">
        <tr>
            <th class="text-left px-4 py-3">Назва</th>
            <th class="text-left px-4 py-3">Категорія</th>
            <th class="text-left px-4 py-3">Ціна</th>
            <th class="text-right px-4 py-3">Дії</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $p)
            <tr class="border-t border-slate-800 hover:bg-slate-950/60 transition">
                <td class="px-4 py-3 font-semibold">{{ $p->name }}</td>
                <td class="px-4 py-3 text-slate-300">{{ $p->category->name }}</td>
                <td class="px-4 py-3 text-amber-400 font-bold">{{ $p->price }} ₴</td>
                <td class="px-4 py-3 text-right">
                    <a href="{{ route('admin.products.edit',$p) }}"
                       class="px-3 py-1.5 rounded-lg bg-slate-800 border border-slate-700 hover:bg-slate-700 transition">
                        Редагувати
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
