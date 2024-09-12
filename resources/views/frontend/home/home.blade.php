@extends('frontend.layouts.master')
@section('title')
Booknest Home Page
@endsection
@section('content')
<main class="pb-5">
  <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner m-0">
        @foreach ($banners as $banner)
          <div class="carousel-item active" data-bs-interval="10000">
            <img src="{{asset($banner->banner_image)}}" class="d-block w-100" alt="...">
          </div>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
  </div>
  <div class="product rounded-3 m-sm-5 p-sm-3 mt-5 m-3 mb-0 p-2">
      <p class="fw-bold mb-0 featured-product">Featured Product</p>
      <div class="row products">
          @foreach ($featuredProducts as $featuredProduct)
            <div class="col-4 col-md-2 p-2 p-sm-3">
              <a href="{{route('product-detail', $featuredProduct->slug)}}">
                <img src="{{asset($featuredProduct->thumb_image)}}" alt="" class="img-fluid h-100">
              </a>
            </div>
          @endforeach
      </div>
  </div>
</main>
@endsection