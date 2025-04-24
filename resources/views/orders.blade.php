<x-main>
    <div class="max-w-5xl mx-auto">
        @foreach($orders as $order)
            <x-order-summary :order="$order"></x-order-summary>
        @endforeach
    </div>
</x-main>
