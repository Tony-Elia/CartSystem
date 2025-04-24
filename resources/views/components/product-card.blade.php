<div class="product-card p-6 m-5 bg-[#333333] flex flex-col justify-around text-white"
     x-data="productCard({{ $key }}, {{ $product['price'] }}, {{ $quantity ?? 1 }})">

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
                x-model="quantity"
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
        <span class="text-xl font-bold text-green-600" x-text="'$' + subtotal.toFixed(2)"></span>
    </div>

    @if(isset($quantity) && $quantity > 0)
            <button
                class="w-full mt-2 px-4 py-2 text-white rounded-full cursor-pointer mr-3"
                @click="updateCart()"
            >
                Update
            </button>
    @endif

</div>

<script>
    function productCard(productId, productPrice, initialQty) {
        return {
            quantity: initialQty,
            productPrice: productPrice,

            get subtotal() {
                return this.quantity * this.productPrice;
            },

            updateCart() {
                fetch('/cart/update', {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: this.quantity
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        this.subtotal = this.quantity * this.productPrice;
                        document.getElementById('order-total').textContent = data.data[0].toFixed(2);
                    });
            }
        }
    }
</script>
