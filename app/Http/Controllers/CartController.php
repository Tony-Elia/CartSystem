<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\ProductService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    use ApiResponse;
    public function __construct(private CartService $cart_service) {}

    public function index()
    {
        return view('cart', ['cart' => session('cart', [])]);
    }

    public function add(Request $request)
    {
        $product_id = $request->product_id;
        $cart = session('cart', []);

        $cart = $this->cart_service->addProduct($cart, $product_id, $request->quantity);

        [$total_amount, $total_cart_items] = $this->updateSessionStats($cart);
        return $this->success([$total_cart_items]);
    }

    public function update(Request $request)
    {
        $cart = $this->cart_service->update(session('cart', []), $request->product_id, $request->quantity);

        return $this->success($this->updateSessionStats($cart));
    }

    public function totalItems(): \Illuminate\Http\JsonResponse
    {
        return $this->success([$this->cart_service->totalCartItems()]);
    }

    public function remove(Request $request)
    {
        $product_id = $request->product_id;
        $cart = $this->cart_service->remove($product_id);

        return $this->success($this->updateSessionStats($cart));
    }

    private function updateSessionStats($cart): array
    {
        session(['cart' => $cart]);
        $total_amount = $this->cart_service->totalAmount($cart);
        session(['total_amount' => $total_amount]);
        $total_cart_items = $this->cart_service->totalCartItems($cart);
        session(['total_cart_items' => $total_cart_items]);
        return [$total_amount, $total_cart_items];
    }
}
