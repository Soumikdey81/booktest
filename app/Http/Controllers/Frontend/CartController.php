<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    /**Add item to cart */
    public function addToCart(Request $request){
        $product = Product::findOrFail($request->product_id);
        
        /**check product quantity */
        if($product->quantity <= 0){
            return response(['status' => 'stock_out', 'message' => 'Product stock out']);
        }

        $productDetails = [];

        $productDetails['name'] = $product->name;
        $productDetails['price'] = $product->price;

        $productTotalAmount = 0;
        if(checkDiscount($product)){
            $productTotalAmount = $product->offer_price;
            $productDiscount = $product->discount;
            $productPrice = $product->price;
        }else{
            $productTotalAmount = $product->price;
            $productDiscount = 0;
            $productPrice = $product->price;
        }

        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = 1;
        $cartData['price'] = $productTotalAmount;
        $cartData['weight'] = 10;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['total_qty'] = $product->quantity;
        $cartData['options']['slug'] = $product->slug;
        $cartData['options']['short_description'] = $product->short_description;
        $cartData['options']['discount'] = $productDiscount;
        $cartData['options']['actual_price'] = $productPrice;

        Cart::add($cartData);

        return response(['status' => 'success', 'message' => 'Added to cart successfully']);
    }

    /**show cart detail page */
    public function cartDetail(){
        $cartItems = Cart::content();
        return view('frontend.product.cart', compact('cartItems'));
    }

    /**update product quantity */
    public function updateProductQty(Request $request){

        $productId = Cart::get($request->rowId)->id;
        $product = Product::findOrFail($productId);

        /**check product quantity */
        if($product->quantity < $request->quantity){
            return response(['status' => 'stock_out', 'message' => 'Quantity not available in our stock']);
        }

        Cart::update($request->rowId, $request->quantity);
        $productPrice = $this->getProductTotalPrice($request->rowId);
        $productActualPrice = $this->getProductTotalActualPrice($request->rowId);
        $productDiscount = $this->getProductDiscountPrice($request->rowId);

        return response(['status' => 'success', 'message' => 'Product Quantity Updated!', 'product_price_total' => $productPrice, 'product_actual_price_total' => $productActualPrice, 'product_total_discount' => $productDiscount]);
    }

    /**get updated product price */
    public function getProductTotalPrice($id){
        $product = Cart::get($id);
        $priceTotal = $product->price * $product->qty;
        return $priceTotal;
    }

    /**get updated product actual price */
    public function getProductTotalActualPrice($id){
        $product = Cart::get($id);
        $priceActualTotal = $product->options->actual_price * $product->qty;
        return $priceActualTotal;
    }

    /**get total product discount price */
    public function getProductDiscountPrice($id){
        $product = Cart::get($id);
        $discount = ($product->options->actual_price * $product->qty) - ($product->price * $product->qty);
        return $discount;
    }

    /**get cart total amount */
    public function cartTotal(){
        $totalPrice = 0;
        $totalDiscount = 0;
        foreach(Cart::content() as $product){
            $totalPrice += $this->getProductTotalPrice($product->rowId);
            $totalDiscount += $this->getProductDiscountPrice($product->rowId);
        }
        $totalAmount = $totalPrice + 55;
        return response(['product_total_price' => $totalPrice, 'product_total_discount' => $totalDiscount, 'product_total_amount' => $totalAmount]);
    }

    /**remove cart product */
    public function removeProduct(Request $request){
        Cart::remove($request->removeId);

        return response(['status' => 'success', 'message' => 'Product removed from cart successfully']);
    }

    /**get cart count */
    public function getCartCount(){
        return Cart::content()->count();
    }

}
