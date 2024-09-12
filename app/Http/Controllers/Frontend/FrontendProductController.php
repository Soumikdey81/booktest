<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    /**Show product detail page */
    public function showProduct(string $slug){
        $product = Product::with(['category', 'productImageGalleries'])->where('slug', $slug)->where('status', 1)->first();
        $similarProducts = Product::where('category_id', $product->category_id)
                          ->where('status', 1)
                          ->where('id', '!=', $product->id)
                          ->get();
        return view('frontend.product.product_detail', compact('product', 'similarProducts'));
    }
}
