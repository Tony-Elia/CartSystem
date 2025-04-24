<?php

namespace App\Services;

class CartService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private ProductService $product_service) {}

    public function addProduct($cart, $product_id, $quantity)
    {
        if(isset($cart[$product_id])) {
            $cart[$product_id]['quantity'] += $quantity;
        } else {
            $prod = $this->product_service->find($product_id);
            $cart[$product_id] = [
                'name' => $prod->name,
                'description' => $prod->description,
                'price' => $prod->price,
                'image' => $prod->image,
                'quantity' => $quantity
            ];
        }
        return $cart;
    }

    public function totalCartItems($cart = null)
    {
        if($cart == null) $cart = $this->getCart(); // if there is no passed cart retrieve it from the session
        return collect($cart)->sum(fn($item) => $item['quantity']);
    }

    public function totalAmount($cart = null)
    {
        if($cart == null) $cart = $this->getCart(); // if there is no passed cart retrieve it from the session
        return collect($cart)->sum(fn($item) => $item['quantity'] * $item['price']);
    }

    public function getCart()
    {
        return session('cart', []);
    }
}
