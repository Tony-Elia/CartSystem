<?php

namespace App\Http\Controllers;

use App\Enums\OrderStatus;
use App\Services\CartService;
use App\Services\OrderService;
use App\Services\ProductService;
use App\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class OrderController extends Controller
{
    use ApiResponse;
    public function __construct(private ProductService $productService, private OrderService $orderService)
    {
    }

    public function index()
    {
        return view('orders', ['orders' => $this->orderService->all()]);
    }

    public function checkout()
    {
        $cart = session('cart', []);

        $msg = 'Order submitted successfully';
        if($cart != []) {
            if(!$this->orderService->checkout($cart)) {
                $msg = 'Failed to checkout';
            } else {
//              Emptying the session vars
                session(['cart' => []]);
                session(['total_amount' => 0]);
                session(['total_cart_items' => 0]);
            }
        } else $msg = 'Cart is empty!';
        return redirect()->route('dashboard')->with('message', $msg);
    }
}
