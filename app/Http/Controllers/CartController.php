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

        session(['cart' => $cart]);
        $count = $this->cart_service->totalCartItems($cart);
        session(['total_cart_items' => $count]);
        $total_amount = $this->cart_service->totalAmount($cart);
        session(['total_amount' => $total_amount]);
        return $this->success([$count]);
    }

    public function update(Request $request)
    {
        $cart = $this->cart_service->update(session('cart', []), $request->product_id, $request->quantity);
        session(['cart' => $cart]);
        $total_amount = $this->cart_service->totalAmount($cart);
        session(['total_amount' => $total_amount]);
        return $this->success([$total_amount]);
    }

    public function totalItems(): \Illuminate\Http\JsonResponse
    {
        return $this->success([$this->cart_service->totalCartItems()]);
    }
}
