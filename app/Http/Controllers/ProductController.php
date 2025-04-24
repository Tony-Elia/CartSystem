<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(private ProductService $service) {}

    public function index()
    {
        return view('welcome', ['products' => $this->service->all()]);
    }
}
