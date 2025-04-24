<div class="product-card p-6 m-5 bg-[#333333] flex flex-col justify-around text-white">
    @if(isset($product['image']))
        <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-full h-64 object-cover rounded">
    @endif
    <div>
        <h2 class="font-semibold text-2xl">{{ $product['name'] }}</h2>
        <p class="text-white/60">{{ $product['description'] }}</p>
    </div>

    <div class="flex flex-row items-center justify-between mt-4">
        @if(isset($quantity) && $quantity > 0)
            <label class="block text-sm font-bold">Quantity in Cart:</label>
            <input
                type="number"
                min="1"
                class="hollow-input w-full text-center"
                value="{{ $quantity }}"
                @input="updateTotal()"
            >
        @else
            <button
                class="w-full mt-2 px-4 py-2 text-white rounded-full cursor-pointer mr-3"
                @click="openModal({ id: {{ $key }}, name: '{{ $product['name'] }}', price: {{ $product['price'] }} })"
            >
                Add to Cart
            </button>
        @endif
        <span class="text-xl font-bold text-green-600">${{ $product['price'] * ($quantity ?? 1) }}</span>
    </div>
</div>
