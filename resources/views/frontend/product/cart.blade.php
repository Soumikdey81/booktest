@extends('frontend.layouts.master')
@section('title')
Booknest Cart Page
@endsection
@section('content')
<main>
    <div class="container-fluid p-2 p-sm-3 p-md-5">
        @if (count($cartItems) == 0)
            <div class="col-12 empty-cart d-flex justify-content-center align-items-center">
                <div>
                    <p class="text-light mb-1 fw-bold fs-4">Your cart is empty</p>
                    <div class="text-center">
                        <a href="{{route('home')}}" type="button" class="btn px-3 fw-bold button">Go To Home</a>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-md-7">
                    @foreach ($cartItems as $cartItem)
                        <div class="card m-2 text-light fw-bold checkout-product">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 col-sm-5 p-2 d-flex justify-content-center align-items-center">
                                        <img src="{{asset($cartItem->options->image)}}" alt="" class="h-100 cart-image img-fluid">
                                    </div>
                                    <div class="col-6 col-sm-7 p-2 px-sm-4">
                                        <p class="cart-header mb-2">{{$cartItem->name}}</p>
                                        @if ($cartItem->options->discount > 0)
                                            <div class="mb-2 d-inline-flex">
                                                <p class="cart-text mx-1 text-success cart-price">{{currency_icon()}}{{$cartItem->price * $cartItem->qty}}</p>
                                                <p class="cart-text text-secondary mx-1 text-decoration-line-through cart-actual-price">{{currency_icon()}}{{$cartItem->options->actual_price * $cartItem->qty}}</p>
                                                <p class="cart-text mx-1 text-danger">{{$cartItem->options->discount}}% off</p>
                                            </div>
                                        @else
                                            <div class="mb-2 d-inline-flex">
                                                <p class="cart-text mx-1 text-success">{{currency_icon()}}{{$cartItem->price * $cartItem->qty}}</p>
                                            </div>
                                        @endif
                                        <div class="input-group mb-2">
                                            <button class="btn checkout-qty-button border border-light border-1 decrement" type="button"><i class="fa-solid fa-minus fw-bold"></i></button>
                                            <input type="text" class="form-control no-hover text-center fw-bold checkout-qty border border-light border-1 product-count" data-rowid={{$cartItem->rowId}} min="1" max="{{$cartItem->options->total_qty}}" data-total-qty="{{ $cartItem->options->total_qty }}" value="{{$cartItem->qty}}" aria-label="Example text with button addon" aria-describedby="button-addon1" readonly>
                                            <button class="btn checkout-qty-button border border-light border-1 increment" type="button"><i class="fa-solid fa-plus fw-bold"></i></button>
                                        </div>
                                        <button type="button" data-removeid="{{$cartItem->rowId}}" class="btn fw-bold button w-100 cart-product-remove-button">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-5">
                    <div class="card m-2 text-light fw-bold checkout-price">
                        <div class="card-header cart-header">
                            PRICE DETAILS
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item fw-bold checkout-price cart-text">Price {{ (getCartCount() > 1) ? getCartCount().' items' : '1 item' }} <span class="float-end"  id="sub_total">{{currency_icon()}}{{getTotalPrice()}}</span></li>
                                <li class="list-group-item fw-bold checkout-price cart-text">Discount <span class="float-end" id="discount">{{currency_icon()}}{{getTotalDiscount()}}</span></li>
                                <li class="list-group-item fw-bold checkout-price cart-text">Delivery Charges <span class="float-end">₹55</span></li>
                                <li class="list-group-item fw-bold checkout-price cart-text">Total Amount <span class="float-end" id="total_amount">{{currency_icon()}}{{getTotalAmount()}}</span></li>
                            </ul>
                            @if (getTotalDiscount() > 0)
                                <p class="card-text cart-header mt-2">You will save {{currency_icon()}}<span id="price_save">{{getTotalDiscount()}}</span> on this order</p>                           
                            @endif
                            <a href="{{route('user.checkout')}}" type="button" class="btn button mt-2 fw-bold w-100">Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</main>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        //Product increment
        $('.increment').on('click', function(e){
            e.preventDefault();
            let input = $(this).siblings('.product-count');
            let quantity = parseInt(input.val()) + 1;
            let totalQty = input.data('total-qty');
            let rowId = input.data('rowid');

            $.ajax({
                url: "{{route('cart.update-quantity')}}",
                method: 'POST',
                data: {
                    rowId: rowId,
                    quantity: quantity,
                },
                success: function(data){
                    if(data.status == 'success'){
                        let productTotal = '{{currency_icon()}}' + data.product_price_total;
                        let productActualTotal = '{{currency_icon()}}' + data.product_actual_price_total;
                        let productDiscount = '{{currency_icon()}}' + data.product_total_discount;
                        $('.cart-price').text(productTotal);
                        $('.cart-actual-price').text(productActualTotal);
                        getCartSubTotal();
                        input.val(quantity);
                        toastr.success(data.message);
                    }else if(data.status == 'stock_out'){
                        if(quantity > totalQty){
                            quantity = totalQty;
                            input.val(quantity);
                            toastr.error(data.message);
                        }
                    }
                },
                error: function(data){

                }
            });
        });

        //Product decrement
        $('.decrement').on('click', function(e){
            e.preventDefault();
            let input = $(this).siblings('.product-count');
            let quantity = parseInt(input.val()) - 1;
            let quantity_counter = quantity;
            let rowId = input.data('rowid');
            if(quantity < 1){
                quantity = 1;
            }
            input.val(quantity);

            $.ajax({
                url: "{{route('cart.update-quantity')}}",
                method: 'POST',
                data: {
                    rowId: rowId,
                    quantity: quantity,
                },
                success: function(data){
                    if(data.status == 'success'){
                        let productTotal = '{{currency_icon()}}' + data.product_price_total;
                        let productActualTotal = '{{currency_icon()}}' + data.product_actual_price_total;
                        let productDiscount = '{{currency_icon()}}' + data.product_total_discount;
                        $('.cart-price').text(productTotal);
                        $('.cart-actual-price').text(productActualTotal);
                        getCartSubTotal();
                        if(quantity_counter > 0){
                            toastr.success(data.message);
                        }
                    }else if(data.status == 'stock_out'){
                        toastr.error(data.message);
                    }
                },
                error: function(data){

                }
            });
        });

        //clear cart
        $('.cart-product-remove-button').on('click', function(e){
            e.preventDefault();
            let removeId = $(this).data('removeid');
            Swal.fire({
                title: "Are you sure?",
                text: "This action will remove this product from your cart",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, remove it!"
            }).then((result) => {
                if (result.isConfirmed) {
                $.ajax({
                    type: 'POST',
                    url: "{{route('cart.remove-product')}}",
                    data: {
                        removeId: removeId
                    },
                    success: function(data){
                        if(data.status == 'success'){
                            Swal.fire({
                            title: "Product Removed",
                            text: data.message
                            })
                            getCartSubTotal();
                            window.location.reload();
                        }else if(data.status == 'error'){
                            Swal.fire({
                            title: "Product Can't Removed",
                            text: data.message
                            });
                        }
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
                }
            });
        });

        /**get cart subtotal */
        function getCartSubTotal(){
            $.ajax({
                method: 'GET',
                url: "{{route('cart.product-total')}}",
                success: function(data){
                    let totalPrice = '{{currency_icon()}}' + data.product_total_price;
                    let totalDiscount= '{{currency_icon()}}' + data.product_total_discount;
                    let productDiscount = '{{currency_icon()}}' + data.product_total_discount;
                    let totalAmount = '{{currency_icon()}}' + data.product_total_amount;
                    $('#sub_total').text(totalPrice);
                    $('#discount').text(totalDiscount);
                    $('#total_amount').text(totalAmount);
                    $('#price_save').text(data.product_total_discount);
                },
                error: function(data){
                    console.log(error);
                }
            })
        }
    });
</script>
@endpush