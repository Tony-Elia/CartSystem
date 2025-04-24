@props(['order'])

<div class="order-summary my-16 p-10 rounded shadow-md">
    <h2 class="text-lg font-semibold mb-4">Order #{{ $order->id }}</h2>

    <table class="w-full text-sm mb-4">
        <thead class="border-b font-medium text-left">
        <tr>
            <th class="pb-2">Product</th>
            <th class="pb-2">Quantity</th>
            <th class="pb-2">Price</th>
            <th class="pb-2">Total Price</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($order->items as $item)
            <tr class="border-b">
                <td class="py-2">{{ $item->product->name }}</td>
                <td class="py-2">{{ $item->quantity }}</td>
                <td class="py-2">${{ number_format($item->price_at_purchase, 2) }}</td>
                <td class="py-2">${{ number_format($item->price_at_purchase * $item->quantity, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="flex justify-between items-center">
        <p class="font-semibold">Total Amount:</p>
        <p class="text-blue-600 font-bold">${{ number_format($order->total_amount, 2) }}</p>
    </div>

    <div class="mt-2">
        <span class="inline-block px-3 py-1 bg-primary text-sm rounded-full">
            {{ ucfirst($order->status->value) }}
        </span>
    </div>
</div>
