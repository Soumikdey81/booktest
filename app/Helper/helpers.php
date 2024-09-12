<?php

/** Set Sidebar item active */
function setActive(array $route){
    if(is_array($route)){
        foreach($route as $r){
            if(request()->routeIs($r)){
                return 'active';
            }
        }
    }
}

/**Check product have video link have or not */
function checkVideoLink($product){
    if($product->video_link != null ){
        return true;
    }
    return false;
}

/**Check product have discount or not */
function checkDiscount($product){
    $currentDate = date('Y-m-d');
    if($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date){
        return true;
    }
    return false;
}


/**get subtotal cart amount */
function getTotalPrice(){
    $totalPrice = 0;
    foreach(\Cart::content() as $product){
        $totalPrice += $product->price * $product->qty;
    }
    return $totalPrice;
}

/**get total product discount */
function getTotalDiscount(){
    $totalDiscount = 0;
    foreach(\Cart::content() as $product){
        $totalDiscount += ($product->options->actual_price * $product->qty) - ($product->price * $product->qty);
    }
    return $totalDiscount;
}

/**get total product amount */
function getTotalAmount(){
    $totalAmount = getTotalPrice() + 55;
    return $totalAmount;
}

/**get cart count */
function getCartCount(){
    return Cart::content()->count();
}

/**get currency icon */
function currency_icon(){
    return json_decode('"\u20B9"');
}
