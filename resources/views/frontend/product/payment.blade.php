@extends('frontend.layouts.master')
@section('title')
Booknest Payment Page
@endsection
@section('content')
<main>
    <div class="container-fluid p-3">
        <div class="row mt-3">
            <div class="col-md-8">
                <div class="card address m-2 mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <p class="cart-header m-0 fw-bold">Delivery Address</p>
                    </div>
                    <div class="card-body cart-text">
                        <b>Name: </b>{{ $address['name'] }}<br>
                        <b>Email: </b>{{ $address['email'] }}<br>
                        <b>Phone: </b>{{ $address['phone'] }}<br>
                        <b>Address: </b>{{ $address['address'] }}<br>
                        <b>Landmark: </b>{{ $address['landmark'] }}<br>
                        <b>Pincode: </b>{{ $address['pincode'] }}<br>
                        <b>City: </b>{{ $address['city'] }}<br>
                        <b>District: </b>{{ $address['district'] }}<br>
                        <b>State: </b>{{ $address['state'] }}<br>
                    </div>
                </div>
                <div class="card product-summary m-2 mb-3">
                    <div class="card-header">
                        <p class="cart-header m-0 fw-bold">Order Summary</p> 
                    </div>
                    <div>
                        @if (count($cartItems) == 0)
                            <div class="col-12 empty-cart d-flex justify-content-center align-items-center">
                                <div>
                                    <p class="mb-1 fw-bold fs-4">Your checkout has no items</p>
                                </div>
                            </div>
                        @else
                            @foreach ($cartItems as $cartItem)
                            <div class="card m-2 fw-bold checkout-product">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6 col-sm-5 p-2 d-flex justify-content-center align-items-center">
                                            <img src="{{asset($cartItem->options->image)}}" alt="" class="h-100 cart-image img-fluid">
                                        </div>
                                        <div class="col-6 col-sm-7 p-2 px-sm-4">
                                            <p class="cart-header mb-2">{{$cartItem->name}}</p>
                                            @if ($cartItem->options->discount > 0)
                                                <div class="d-inline-flex mb-2">
                                                    <p class="cart-text m-0 me-1 text-success cart-price">{{currency_icon()}}{{$cartItem->price * $cartItem->qty}}</p>
                                                    <p class="cart-text m-0 text-secondary me-1 text-decoration-line-through cart-actual-price">{{currency_icon()}}{{$cartItem->options->actual_price * $cartItem->qty}}</p>
                                                    <p class="cart-text m-0 me-1 text-danger">{{$cartItem->options->discount}}% off</p>
                                                </div>
                                                <p class="cart-text m-0">{{($cartItem->qty > 1) ? $cartItem.'items' : '1 item'}}</p>
                                            @else
                                                <div class="mb-2 d-inline-flex">
                                                    <p class="cart-text me-1 text-success">{{currency_icon()}}{{$cartItem->price * $cartItem->qty}}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card m-2 fw-bold checkout-price">
                    <div class="card-header">
                        <p class="m-0 cart-header fw-bold">Price Details</p>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item fw-bold checkout-price cart-text">Price {{ (getCartCount() > 1) ? getCartCount().' items' : '1 item' }} <span class="float-end"  id="sub_total">{{currency_icon()}}{{getTotalPrice()}}</span></li>
                            <li class="list-group-item fw-bold checkout-price cart-text">Discount <span class="float-end" id="discount">{{currency_icon()}}{{getTotalDiscount()}}</span></li>
                            <li class="list-group-item fw-bold checkout-price cart-text">Delivery Charges <span class="float-end">₹55</span></li>
                            <li class="list-group-item fw-bold checkout-price cart-text">Total Amount <span class="float-end" id="total_amount">{{currency_icon()}}{{getTotalAmount()}}</span></li>
                        </ul>
                        <p class="card-text cart-header mt-2">You will save {{currency_icon()}}<span id="price_save">{{getTotalDiscount()}}</span> on this order</p>
                    </div>
                    <div class="card-footer">
                        {{-- @php
                            $razorpaySetting = \App\Modes\lRazorpaySetting::first();
                            $total= getFinalPayableAmount();
                        @endphp
                        <form action="{{route('user.razorpay.payment')}}" method="POST">
                            @csrf
                            <script src="https://checkout.razorpay.com/v1/checkout.js"
                                data-key="{{$razorpaySetting->razorpay_key}}"
                                data-amount="{{$total}}"
                                data-buttontext="Pay With Razorpay"
                                data-name="Booknest"
                                data-description="Payment"
                                data-prefill.name="{{Auth::user()->name}}"
                                data-prefill.email="{{Auth::user()->email}}"
                                data-theme.color="#ff7520"
                            >
                            </script>
                        </form> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
{{-- <div class="container">
    <div class="card">
        <div class="card-body">
            @php
                $razorpaySetting = \App\Modes\lRazorpaySetting::first();
                $total= getFinalPayableAmount();
            @endphp
            <form action="{{route('user.razorpay.payment')}}" method="POST">
                @csrf
                <script src="https://checkout.razorpay.com/v1/checkout.js"
                    data-key="{{$razorpaySetting->razorpay_key}}"
                    data-amount="{{$total}}"
                    data-buttontext="Pay With Razorpay"
                    data-name="Booknest"
                    data-description="Payment"
                    data-prefill.name="{{Auth::user()->name}}"
                    data-prefill.email="{{Auth::user()->email}}"
                    data-theme.color="#ff7520"
                >
                </script>
            </form>
        </div>
    </div>
</div> --}}
@endsection