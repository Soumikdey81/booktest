<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\RazorpaySetting;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Razorpay\Api\Api;
use Auth;
use Cart;

class PaymentController extends Controller
{
    public function index(){
        if(!Session::has('address')){
            return redirect()->route('user.checkout');
        }
        $cartItems = Cart::content();
        $address = Session::get('address');
        return view('frontend.product.payment', compact('cartItems', 'address'));
    }

    public function paymentSuccess(){
        return view('frontend.product.payment-success');
    }

    public function storeOrder($paymentMethod, $paymentStatus, $transactionId, $paidCurrencyName){
        $setting = GeneralSetting::first();

        $order = new Order();
        $order->invocie_id = rand(1, 999999);
        $order->user_id = Auth::user()->id;
        $order->sub_total = getMainCartTotal();
        $order->amount = getFinalPayableAmount();
        $order->currency_name = $setting->currency_name;
        $order->currency_icon = $setting->currency_icon;
        $order->product_qty = \Cart::content()->count();
        $order->payment_method = $paymentMethod;
        $order->payment_status = $paymentStatus;
        $order->order_address = json_encode(Session::get('address'));
        $order->order_status = 'pending';
        $order->save();

        //store order products
        foreach(\Cart::content() as $item){
            $product = Product::find($item->id);
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $order->id;
            $orderProduct->product_id = $product->id;
            $orderProduct->product_name = $product->name;
            $orderProduct->unit_price = $item->price;
            $orderProduct->product_id = $product->id;
            $orderProduct->qty = $item->qty;
            $orderProduct->save();
        }

        //store transaction details
        $transaction = new Transaction();
        $transaction->order_id = $order->id;
        $transaction->transaction_id = $transactionId;
        $transaction->payment_method = $paymentMethod;
        $transaction->amount = getFinalPayableAmount();
        $transaction->currency_name = $paidCurrencyName;
        $transaction->save();
    }

    public function clearSession(){
        \Cart::destroy();
        Session::forget('address');
    }

    public function payWithRazorPay(Request $request){
        $razorpaySetting = RazorpaySetting::first();
        $api = new Api($razorpaySetting->razorpay_key, $razorpaySetting->razorpay_secret_key);
        // amount calculation
        $total = getFinalPayableAmount();
        if($request->has('razorpay_payment_id') && $request->filled('razorpay_payment_id')){
            try{
                $response = $api->payment->fetch($request->razorpay_payment_id)
                    ->capture(['amount' => $total]);
            }catch(\Exception $e){
                toastr($e->getMessage(), 'error', 'Error');
                return redirect()->back();
            }
            if($response['status'] == 'captured'){
                $this->storeOrder('razorpay', 1, $response['id'], $total, $razorpaySetting->currency_name);
                //clear session
                $this->clearSession();

                return redirect()->route('user.payment.success');
            }
        }
    }
}
