<x-main>

    <!-- Message Box (Dismissible) -->
    <x-flash-message :initialMessage="session('message')" />

    <div x-data="cartHandler()">

        <!-- Product Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 md:max-w-5xl mx-auto gap-2.5 md:gap-4 m-4">
            @foreach($products as $product)
                <x-product-card :product="$product" :key="$product->id" />
            @endforeach
        </div>

        <!-- Quantity Modal -->
        <div
            x-show="showModal"
            x-transition
            class="fixed inset-0 bg-black/60 flex items-center justify-center z-40"
        >
            <div class="bg-main p-6 shadow-lg w-full max-w-sm z-50 text-white rounded-3xl"
                @click.outside="resetModal()">
                <h2 class="text-xl font-semibold mb-4" x-text="selectedProduct?.name"></h2>
                <p class="mb-2">Price: $<span x-text="totalPrice"></span></p>

                <label class="block mb-2">
                    Quantity:
                    <input type="number" min="1" class="hollow-input w-full" x-model="quantity">
                </label>

                <div class="flex justify-between mt-4">
                    <button class="btn danger px-4 py-2 rounded-3xl" @click="resetModal()">Cancel</button>
                    <button class="btn w-full ml-3 bg-blue-600 text-white px-4 py-2 rounded-3xl" @click="submitCart()">Add</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function cartHandler() {
            return {
                showModal: false,
                quantity: 1,
                selectedProduct: null,

                openModal(product) {
                    this.selectedProduct = product;
                    this.quantity = 1;
                    this.showModal = true;
                },

                resetModal() {
                    this.showModal = false;
                    this.selectedProduct = null;
                    this.quantity = 1;
                },

                submitCart() {
                    fetch('/cart/add', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            product_id: this.selectedProduct.id,
                            quantity: this.quantity
                        })
                    })
                        .then(data => data.json())
                        .then(data => {
                            const flash = document.querySelector('[x-data^="flashMessage"]')?._x_dataStack?.[0];
                            if (data.status) {
                                this.loadCart(data.data[0]);
                                flash?.show('Product added successfully');
                            } else {
                                flash?.show(data.message ?? 'Something went wrong');
                            }
                            this.resetModal();
                        });
                },

                loadCart(count) {
                    document.getElementById('cart-counter').textContent = count;
                },

                get totalPrice() {
                    if (!this.selectedProduct) return 0;
                    return (this.selectedProduct.price * this.quantity).toFixed(2);
                }
            }
        }
    </script>
</x-main>
