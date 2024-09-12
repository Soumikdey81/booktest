<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $featuredProducts = Product::where('status', 1)->where('product_type', 'featured_product')->get();
        $categories = Category::all();
        return view('frontend.home.home', compact('banners', 'featuredProducts', 'categories'));
    }
    public function store()
    {
        $featuredProducts = Product::where('status', 1)->where('product_type', 'featured_product')->get();
        $categories = Category::all();
        return view('frontend.store.store', compact('featuredProducts', 'categories'));
    }
}
