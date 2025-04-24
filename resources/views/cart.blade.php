<x-app-layout>
    <div class="flex flex-col m-4 mx-auto md:max-w-5xl">

        <!-- Product Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2.5 md:gap-4">
            @foreach($cart as $id => $product)
                <x-product-card :product="$product" :key="$id" :quantity="$product['quantity']" />
            @endforeach
        </div>

        <div class="font-black ml-10 my-10 flex flex-row flex-nowrap items-baseline justify-between">
            <h1 class="text-3xl">Total Amount: $<span id="order-total">{{ session('total_amount', 0) }}</span></h1>
            <form method="POST" action="{{ route('order.checkout') }}">
                @csrf

                <button type="submit" class="text-xl ml-4 rounded-full py-3 px-[100px]">Checkout</button>
            </form>
        </div>

    </div>
</x-app-layout>
