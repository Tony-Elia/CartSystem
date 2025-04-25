<div class="product-card p-6 m-5 bg-[#333333] flex flex-col justify-around text-white"
     x-data="productCard({{ $key }}, {{ $product['price'] }}, {{ $quantity ?? 1 }})"
    id="{{ $key }}">

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
                class="btn w-full mt-2 px-4 py-2 text-white rounded-full cursor-pointer mr-3"
                @click="openModal({ id: {{ $key }}, name: '{{ $product['name'] }}', price: {{ $product['price'] }} })"
            >
                Add to Cart
            </button>
        @endif
        <span class="text-xl font-bold text-green-600" x-text="'$' + subtotal.toFixed(2)"></span>
    </div>

    @if(isset($quantity) && $quantity > 0)
        <div class="flex flex-row mt-2">
            <button
                class="btn w-1/2 danger rounded-full px-4 py-2 mr-3"
                @click="cartStore().deleteFromCart({ id: {{ $key }} })"
            >
                Remove Item
            </button>

            <button
                class="btn w-full px-4 py-2 text-white rounded-full cursor-pointer"
                @click="updateCart()"
            >
                Update
            </button>
        </div>
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
                updateCartRequest(productId, this.quantity)
                    .then(data => {
                        if (data.status) {
                            document.getElementById('order-total').textContent = data.data[0].toFixed(2);
                            document.getElementById('cart-counter').textContent = data.data[1];
                            flash('Quantity updated successfully');
                        } else {
                            flash(data.message ?? 'Something went wrong');
                        }
                    });
            }

        }
    }
</script>
