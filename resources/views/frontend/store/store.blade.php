@extends('frontend.layouts.master')
@section('title')
Booknest Store Page
@endsection
@section('content')
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-2 col-lg-3 col-md-3 pt-md-4 p-md-2 border-end book-genre">
                <p class="text-center border border-1 border-light text-light fw-bold">Book Genre</p>
                <div class="book-genre-list">
                    <ul class="menu list-unstyled border-0 w-100">
                        @foreach ($categories as $category)
                        @if (count($category->subCategories) > 0)
                            <li>
                                <a class="menu-item text-decoration-none text-light fw-bold pe-0 py-1 d-flex justify-content-between align-items-center nested-dropdown" href="#">
                                    <span>{{$category->name}}</span>
                                    <i class="fa-solid fa-caret-down"></i>
                                </a>
                                <ul class="submenu list-unstyled border-0 ps-2">
                                    @foreach ($category->subCategories as $subCategory)
                                    @if (count($subCategory->childCategories) > 0)
                                        <li>
                                            <a class="menu-item text-decoration-none text-light fw-bold py-1 pe-0 d-flex justify-content-between align-items-center nested-dropdown" href="#">
                                                <span>{{$subCategory->name}}</span>
                                                <i class="fa-solid fa-caret-down"></i>
                                            </a>
                                            <ul class="submenu list-unstyled border-0 ps-3">
                                                @foreach ($subCategory->childCategories as $childCategory)
                                                    <li><a class="menu-item text-decoration-none text-light fw-bold" href="#">{{$childCategory->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                        <li><a class="menu-item text-decoration-none text-light fw-bold" href="#">{{$subCategory->name}}</a></li>
                                    @endif
                                    @endforeach
                                </ul>
                            </li>
                        @else
                            <li><a class="menu-item text-decoration-none text-light fw-bold" href="#">{{$category->name}}</a></li>
                        @endif
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-12 col-xl-10 col-lg-9 col-md-9 pt-sm-4 p-2 book-product">
                <div class="my-3 p-2 rounded-3 search">
                    <input type="text" class="form-control" placeholder="Search for books..." aria-label="Search for books..." aria-describedby="button-addon2">
                </div>
                <div class="product rounded-3 m-3 my-5 p-2">
                    <p class="fw-bold mb-0 featured-product">Featured Products</p>
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
                <div class="product rounded-3 m-3 mt-5 p-2">
                    <p class="fw-bold mb-0 featured-product">New Arrival Products</p>
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
                <div class="product rounded-3 m-3 mt-5 p-2">
                    <p class="fw-bold mb-0 featured-product">Top Products</p>
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
            </div>
        </div>
    </div>
</main>
@endsection