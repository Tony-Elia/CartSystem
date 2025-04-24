<?php

namespace App\Services;

use App\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private ProductService $productService)
    {
        //
    }

    public function checkout($cart): bool
    {
        try {
            DB::beginTransaction();

            $order = $this->createOrder([
                'user_id' => auth()->id(),
                'status' => OrderStatus::Pending->value,
                'total_amount' => 0
            ]);
            $sum = 0;
            foreach ($cart as $id => $product) {
                $ret_prod = $this->productService->find($id);

                $sum += $product['quantity'] * $ret_prod['price'];
                $order->items()->create([
                    'product_id' => $ret_prod->id,
                    'price_at_purchase' => $ret_prod->price, // for data integrity
                    'quantity' => $product['quantity']
                ]);
            }

            $order->update(['total_amount' => $sum]);
            DB::commit();
            return true;
        } catch(Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function createOrder($request)
    {
        return Order::create($request); // fillable will filter the request body
    }

    public function all()
    {
        $user_id = Auth::id();

        return Order::where('user_id', $user_id)->with('items.product')->get();
    }
}
