@php
  $address = json_decode($order->order_address);
  $shipping = json_decode($order->shipping_method);
@endphp
@extends('admin.layouts.master')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Orders</h1>
    </div>
    <div class="section-body">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h4>Order Details</h4>
            </div>
            <div class="section-body">
                <div class="invoice">
                  <div class="invoice-print">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="invoice-title">
                          <h2>Invoice</h2>
                          <div class="invoice-number">Order #{{$order->invocie_id}}</div>
                        </div>
                        <hr>
                        <div class="row">
                          <div class="col-md-6">
                            <address>
                              <strong>Billed To:</strong><br>
                                <b>Name:</b> {{$address->name}}<br>
                                <b>Email:</b> {{$address->email}}<br>
                                <b>Phone:</b> {{$address->phone}}<br>
                                <b>Address:</b> {{$address->address}}<br>
                                {{$address->landmark}}<br>
                                {{$address->city}}, {{$address->district}}, {{$address->pincode}}<br>
                                {{$address->state}}
                            </address>
                          </div>
                          <div class="col-md-6 text-md-right">
                            <address>
                              <strong>Shipped To:</strong><br>
                                <b>Name:</b> {{$address->name}}<br>
                                <b>Email:</b> {{$address->email}}<br>
                                <b>Phone:</b> {{$address->phone}}<br>
                                <b>Address:</b> {{$address->address}}<br>
                                {{$address->landmark}}<br>
                                {{$address->city}}, {{$address->district}}, {{$address->pincode}}<br>
                                {{$address->state}}
                            </address>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6">
                            <address>
                              <strong>Payment Information:</strong><br>
                              <b>Method:</b> {{$order->payment_method}}<br>
                              <b>Transaction Id:</b> {{@$order->transaction->transaction_id}}<br>
                              <b>Status: </b> {{$order->payment_status == 1 ? 'Complete' : 'Pending'}}
                            </address>
                          </div>
                          <div class="col-md-6 text-md-right">
                            <address>
                              <strong>Order Date:</strong><br>
                              {{date('d F, Y', strtotime($order->created_at))}}<br><br>
                            </address>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row mt-4">
                      <div class="col-md-12">
                        <div class="section-title">Order Summary</div>
                        <p class="section-lead">All items here cannot be deleted.</p>
                        <div class="table-responsive">
                          <table class="table table-striped table-hover table-md">
                            <tr>
                              <th data-width="40">#</th>
                              <th>Item</th>
                              <th class="text-center">Price</th>
                              <th class="text-center">Quantity</th>
                              <th class="text-right">Totals</th>
                            </tr>
                            @foreach ($order->orderProducts as $product)
                              <tr>
                                <td>{{++$loop->index}}</td>
                                <td>{{$product->product_name}}</td>
                                <td class="text-center">{{$settings->currency_icon}}{{$product->unit_price}}</td>
                                <td class="text-center">{{$product->qty}}</td>
                                <td class="text-right">{{$settings->currency_icon}}{{$product->unit_price * $product->qty}}</td>
                              </tr>
                            @endforeach
                          </table>
                        </div>
                        <div class="row mt-4">
                          <div class="col-lg-8">
                            <div class="col-md-4">
                              <div class="form-group">
                                <label for="">Payment Status</label>
                                <select name="payment_status" id="payment_status" data-id="{{$order->id}}" class="form-control">
                                  <option {{$order->payment_status == 0 ? 'selected' : ''}} value="0">Pending</option>
                                  <option {{$order->payment_status == 1 ? 'selected' : ''}} value="1">Completed</option>
                                </select>
                              </div>
                              <div class="form-group">
                                <label for="">Order Status</label>
                                <select name="order_status" id="order_status" data-id="{{$order->id}}" class="form-control">
                                  @foreach (config('order_status.order_status_admin') as $key => $orderStatus)
                                    <option {{$order->order_status == $key ? 'selected' : ''}} value="{{$key}}">{{$orderStatus['status']}}</option>                                   
                                  @endforeach
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class="col-lg-4 text-right">
                            <div class="invoice-detail-item">
                              <div class="invoice-detail-name">Subtotal</div>
                              <div class="invoice-detail-value">{{$settings->currency_icon}} {{$order->sub_total}}</div>
                            </div>
                            <div class="invoice-detail-item">
                              <div class="invoice-detail-name">Shipping</div>
                              <div class="invoice-detail-value">{{$settings->currency_icon}} {{$order->delivery_charge}}</div>
                            </div>
                            <hr class="mt-2 mb-2">
                            <div class="invoice-detail-item">
                              <div class="invoice-detail-name">Total</div>
                              <div class="invoice-detail-value invoice-detail-value-lg">{{$settings->currency_icon}} {{$order->amount}}</div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="text-md-right">
                    <button class="btn btn-warning btn-icon print_invoice icon-left"><i class="fas fa-print"></i> Print</button>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script>
    $(document).ready(function(){
      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });
      /**order status update */
      $('#order_status').on('change', function(){
        let status = $(this).val();
        let id = $(this).data('id');
        $.ajax({
          method: 'GET',
          url: '{{route(admin.order.status)}}',
          data: {status: status, id: id},
          success: function(data){
            if(data.status == 'success'){
              toastr.success(data.message);
            }
          },
          error: function(data){
            console.log(data);
          }
        })
      })
      /**payment status update */
      $('#payment_status').on('change', function(){
        let status = $(this).val();
        let id = $(this).data('id');
        $.ajax({
          method: 'GET',
          url: '{{route(admin.payment.status)}}',
          data: {status: status, id: id},
          success: function(data){
            if(data.status == 'success'){
              toastr.success(data.message);
            }
          },
          error: function(data){
            console.log(data);
          }
        })
      })  
      /**print page */
      $('.print_invoice').on('click', function(){
        let printBody = $('.invoice-print');
        let originalContents = $('body').html();
        $('body').html(printBody.html());
        window.print();
        $('body').html(originalContents);
      })
    })
  </script>
@endpush