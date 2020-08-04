<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return response()->json(['products' => $products], 200);
    }


    public function store(ProductStoreRequest $request)
    {

    }


    public function update(ProductUpdateRequest $request, Product $product)
    {

    }

    public function destroy(Request $request, Product $product)
    {
    }
}
