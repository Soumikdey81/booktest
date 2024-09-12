@extends('frontend.layouts.master')
@section('title')
Booknest Product Detail Page
@endsection
@section('content')
<main>
    <div class="container-fluid pt-5 p-2">
        <div class="row product-detail rounded-3 m-sm-3 m-2">
            <div class="col-md-6 col-lg-4 swiper p-3 product-image">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                  <!-- Slides -->
                  @foreach ($product->productImageGalleries as $productImage)
                    <div class="swiper-slide d-flex justify-content-center align-items-center position-relative">
                      <img src="{{asset($productImage->image)}}" alt="Product Image" class="img-fluid px-3 pb-4">
                      @if (checkVideoLink($product))
                        <a href="{{asset($product->video_link)}}" class="product-video position-absolute top-50 start-50 translate-middle">
                          <i class="fa-solid fa-play fs-3"></i>
                        </a>
                      @endif
                    </div>
                  @endforeach
                  <!-- Add the main product image as the first slide -->
                  <div class="swiper-slide d-flex justify-content-center align-items-center position-relative">
                    <img src="{{asset($product->thumb_image)}}" alt="Product Image" class="img-fluid px-3 pb-4">
                    @if (checkVideoLink($product))
                      <a href="{{asset($product->video_link)}}" class="product-video position-absolute top-50 start-50 translate-middle">
                        <i class="fa-solid fa-play fs-3"></i>
                      </a>
                    @endif
                  </div>
                </div>
                <div class="swiper-pagination py-3 bottom-0 start-50 translate-middle-x"></div>
            </div>
            <div class="col-md-6 col-lg-8 text-light p-3 px-md-5 rounded-3">
                <p class="m-0 fs-5 fw-bold cart-header">{{$product->name}}</p>
                <p class="fw-bold cart-text">{{$product->short_description}}</p>
                <div>
                    @if (checkDiscount($product))
                        <p class="fw-bold fs-5 product-header m-0">Special Offer</p>
                        <div class="pb-3 d-inline-flex">
                            <p class="fw-bold m-0 mx-1 text-success">{{currency_icon()}}{{$product->offer_price}}</p>
                            <p class="fw-bold m-0 mx-1 text-secondary text-decoration-line-through">{{currency_icon()}}{{$product->price}}</p>
                            <p class="fw-bold m-0 mx-1 text-danger">{{$product->discount}}% off</p>
                        </div>
                    @else
                        <div class="pb-3">
                            <span class="fw-bold text-success">{{currency_icon()}}{{$product->price}}</span>
                        </div>
                    @endif
                </div>
                <form class="shopping_cart_form">
                    <input type="hidden" name="product_id" value="{{$product->id}}">
                    <button type="submit" class="btn button fw-bold w-100">Add to cart</button>
                </form>
                <p class="mt-3 m-0 fw-bold cart-header">Description</p>
                <p class="fw-bold cart-text">{{$product->long_description}}</p>
            </div>
        </div>
    </div>
    <div class="container-fluid pt-5 p-2">
        <div class="product rounded-3 m-3 my-5 p-2">
            <p class="fw-bold mb-0 featured-product">Related Products</p>
            <div class="row products">
                @foreach ($similarProducts as $similarProduct)
                  <div class="col-4 col-md-2 p-2 p-sm-3">
                    <a href="{{route('product-detail', $similarProduct->slug)}}">
                      <img src="{{asset($similarProduct->thumb_image)}}" alt="" class="img-fluid h-100">
                    </a>
                  </div>
                @endforeach
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
            
            //add product into cart
            $('.shopping_cart_form').on('submit', function(e){
                e.preventDefault();
                let formData = $(this).serialize();
                $.ajax({
                    method: 'POST',
                    data: formData,
                    url: "{{route('add-to-cart')}}",
                    success: function(data){
                        if(data.status == 'success'){
                            window.location.href = "{{route('cart-detail')}}";
                        }else if(data.status == 'stock_out'){
                            toastr.error(data.message);
                        }
                    },
                    error: function(data){

                    }
                })
            });
        });
    </script>
@endpush