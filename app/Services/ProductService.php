<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return Product::all();
    }

    public function find($id)
    {
        return Product::find($id);
    }
}
