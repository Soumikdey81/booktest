@extends('frontend.layouts.master')
@section('title')
Booknest Checkout Page
@endsection
@section('content')
{{-- <div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title">Choose your Delivery Address:</h5>
                    <!-- Button trigger modal -->

                </div>
                <div class="card-body row row-cols-2">
                    @foreach ($addresses as $address)
                        <div class="form-check">
                            <div class="card">
                                <div class="card-header ps-5">
                                    <input class="form-check-input shipping_address" data-id="{{$address->id}}" type="radio" name="exampleRadios" id="exampleRadios1" value="">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Select Address
                                    </label>
                                </div>
                                <div class="card-body">
                                    <table class="table table-bordered table-striped table-hover">
                                        <tbody>
                                            <tr>
                                                <th scope="row">Name:</th>
                                                <td>{{$address->name}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Email:</th>
                                                <td>{{$address->email}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Phone:</th>
                                                <td>{{$address->phone}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Address:</th>
                                                <td>{{$address->address}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Landmark:</th>
                                                <td>{{$address->landmark}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Pincode:</th>
                                                <td>{{$address->pincode}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">City:</th>
                                                <td>{{$address->city}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">District:</th>
                                                <td>{{$address->district}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">State:</th>
                                                <td>{{$address->state}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="card-footer w-100">
                                    <a href="" class="btn btn-primary w-100">Edit</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title">PRICE DETAILS</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <p>Price ({{getCartCount()}} items)</p>
                        <p>&#8377;{{getTotalPrice()}}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p class="card-text">Delivery Charges</p>
                        <p class="card-text">&#8377;40</p>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p class="card-text">Total Payable</p>
                        <p class="card-text">&#8377;{{getTotalPrice() + 40}}</p>
                    </div>
                    <p class="card-text">Your Total Savings on this order ₹5,600</p>
                </div>
                <div class="card-footer">
                    <form action="" id="checkoutForm">
                        <input type="hidden" name="shipping_address_id" value="" id="shipping_address_id">
                    </form>
                    <a class="btn btn-primary w-100 submitCheckoutForm" href="">Place Order</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<main>
    <div class="container-fluid p-3">
        <div class="row mt-3">
            <div class="col-md-8">
                <div class="card address m-2 mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <p class="cart-header m-0 fw-bold">Delivery Address</p>
                        {{-- <a href="" class="btn fw-bold button">Create Address</a> --}}
                        <button type="button" class="btn fw-bold button" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Create New Address
                        </button>
                        
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content address">
                                    <form action="{{route('user.checkout.address-create')}}" method="POST">
                                        @csrf
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold cart-header" id="exampleModalLabel">Create Address</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-2">
                                                <label for="name" class="form-label fw-bold cart-header">Name</label>
                                                <input type="text" class="form-control fw-bold cart-text" id="name" name="name">
                                            </div>
                                            <div class="mb-2">
                                                <label for="email" class="form-label fw-bold cart-header">Email address</label>
                                                <input type="email" class="form-control fw-bold cart-text" id="email" name="email">
                                            </div>
                                            <div class="mb-2">
                                                <label for="phone" class="form-label fw-bold cart-header">Phone</label>
                                                <input type="tel" class="form-control fw-bold cart-text" id="phone" name="phone">
                                            </div>
                                            <div class="mb-2">
                                                <label for="address" class="form-label fw-bold cart-header">Address</label>
                                                <textarea type="text" class="form-control fw-bold cart-text" id="address" name="address"></textarea>
                                            </div>
                                            <div class="mb-2">
                                                <label for="landmark" class="form-label fw-bold cart-header">Landmark</label>
                                                <textarea type="text" class="form-control fw-bold cart-text" id="landmark" name="landmark"></textarea>
                                            </div>
                                            <div class="mb-2">
                                                <label for="city" class="form-label fw-bold cart-header">City</label>
                                                <input type="text" class="form-control fw-bold cart-text" id="city" name="city">
                                            </div>
                                            <div class="mb-2">
                                                <label for="pincode" class="form-label fw-bold cart-header">Pincode</label>
                                                <input type="text" class="form-control fw-bold cart-text" id="pincode" name="pincode">
                                            </div>
                                            <div class="mb-2">
                                                <label for="district" class="form-label fw-bold cart-header">District</label>
                                                <input type="text" class="form-control fw-bold cart-text" id="district" name="district">
                                            </div>
                                            <div class="mb-2">
                                                <label for="state" class="form-label fw-bold cart-header">State</label>
                                                <select name="state" id="state" class="form-control select2">
                                                    <option value="">Select</option>
                                                    @foreach (config('setting.state_list') as $state)
                                                        <option value="{{$state}}">{{$state}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-2">
                                                <label for="type" class="form-label fw-bold cart-header">Type of Address</label>
                                                <select name="type" id="type" class="form-control">
                                                    <option value="Home">Home</option>
                                                    <option value="Work">Work</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" clbuttonss="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row p-2 d-flex justify-content-between">
                            <div class="card mb-3 address-detail">
                                <div class="card-header">
                                    <div class="cart-header"><b>Choose Address</b></div>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="custom-select">
                                            <div class="select-selected cart-header border border-light border-1 rounded-3 p-1 cart-text fw-bold">Select Address</div>
                                            <div class="select-items select-hide rounded-3 mt-1" id="address-list">
                                                @foreach ($addresses as $address)
                                                    <div value="{{ $address->id }}" class="cart-text fw-bold p-1 border">{{ $address->address }}, {{ $address->city }}</div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="card address-detail">
                                <div class="card-header">
                                    <div class="cart-header"><b>Address Details</b></div>
                                </div>
                                <div class="card-body cart-text" id="address-details">
                                    <!-- address details will be displayed here -->
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn fw-bold button w-100">Edit Address</button>
                                </div>
                            </div>
                        </div>
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
                                                    <p class="cart-text me-1 text-danger">{{$cartItem->options->discount}}% off</p>
                                                </div>
                                            @else
                                                <div class="mb-2 d-inline-flex">
                                                    <p class="cart-text me-1 text-success">{{currency_icon()}}{{$cartItem->price * $cartItem->qty}}</p>
                                                </div>
                                            @endif
                                            <div class="input-group mb-2">
                                                <button class="btn checkout-qty-button border border-light border-1 decrement" type="button"><i class="fa-solid fa-minus fw-bold"></i></button>
                                                <input type="text" class="form-control no-hover text-center fw-bold checkout-qty border border-light border-1 product-count" data-rowid={{$cartItem->rowId}} min="1" max="{{$cartItem->options->total_qty}}" data-total-qty="{{ $cartItem->options->total_qty }}" value="{{$cartItem->qty}}" aria-label="Example text with button addon" aria-describedby="button-addon1" readonly>
                                                <button class="btn checkout-qty-button border border-light border-1 increment" type="button"><i class="fa-solid fa-plus fw-bold"></i></button>
                                            </div>
                                            <button type="button" data-removeid="{{$cartItem->rowId}}" class="btn fw-bold button w-100">Remove</button>
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
                        {{-- <a href="{{route('user.checkout')}}" type="button" class="btn button fw-bold w-100">Proceed to Payment</a> --}}
                    </div>
                    <div class="card-footer">
                        <form action="" id="checkoutForm">
                            <input type="hidden" name="shipping_address_id" value="" id="shipping_address_id">
                        </form>
                        <a class="btn button fw-bold w-100 submitCheckoutForm" href="">Place Order</a>
                    </div>
                </div>
            </div>
        </div>
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

        /**address details update */
        $('#address-list .cart-text').on('click', function() {
            let addressId = $(this).attr('value');
            $.ajax({
                method: 'POST',
                url: "{{route('user.checkout.get-address-details')}}",
                data: { address_id: addressId},
                success: function(data){
                    // console.log(data.address);
                    let addressHtml = '';
                    addressHtml += '<b>Name: </b>' + data.address.name + '<br>';
                    addressHtml += '<b>Email: </b>' + data.address.email + '<br>';
                    addressHtml += '<b>Phone: </b>' + data.address.phone + '<br>';
                    addressHtml += '<b>Address: </b>' + data.address.address + '<br>';
                    addressHtml += '<b>Landmark: </b>' + data.address.landmark + '<br>';
                    addressHtml += '<b>Pincode: </b>' + data.address.pincode + '<br>';
                    addressHtml += '<b>City: </b>' + data.address.city + '<br>';
                    addressHtml += '<b>District: </b>' + data.address.district + '<br>';
                    addressHtml += '<b>State: </b>' + data.address.state + '<br>';
                    $('#address-details').html(addressHtml);
                }
            });
        });

        /**set choosen address id in form input */
        $('#address-list .cart-text').on('click', function(){
            let shippingAddressId = $(this).attr('value');
            $('#shipping_address_id').val(shippingAddressId);
        });

        /**submit checkout form */
        $('.submitCheckoutForm').on('click', function(e){
            e.preventDefault();
            if($('#shipping_address_id').val() === ""){
                toastr.error('Please select shipping address');
            }else{
                $.ajax({
                    method: 'POST',
                    url: "{{route('user.checkout.form-submit')}}",
                    data: $('#checkoutForm').serialize(),
                    beforeSend: function(){
                        $('.submitCheckoutForm').html('<i class="fas fa-spinner fa-spin fa-1x"></i>');
                    },
                    success: function(data){
                        $('.submitCheckoutForm').text('Place Order');
                        window.location.href = data.redirect_url;
                    },
                    error: function(data){
                        
                    }
                });
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

        /**address detail change */
        // let addresses = {!! json_encode($addresses) !!};
        // $(".select-items").on("click", ".cart-text", function() {
        //     let addressId = $(this).attr("value");
        //     let address = addresses.find(function(address) {
        //         return address.id === parseInt(addressId);
        //     });
        //     if (address) {
        //         let html = `
        //         <b>Name: </b class="cart-text">${address.name}<br>
        //         <b>Email: </b class="cart-text">${address.email}<br>
        //         <b>Phone: </b class="cart-text">${address.phone}<br>
        //         <b>Address: </b class="cart-text">${address.address}<br>
        //         <b>Landmark: </b class="cart-text">${address.landmark}<br>
        //         <b>Pincode: </b class="cart-text">${address.pincode}<br>
        //         <b>City: </b class="cart-text">${address.city}<br>
        //         <b>District: </b class="cart-text">${address.district}<br>
        //         <b>State: </b class="cart-text">${address.state}<br>
        //         `;
        //         $("#address-details").html(html);
        //     }
        // });
    });
</script>
@endpush