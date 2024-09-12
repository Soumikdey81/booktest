@php
    $categories = \App\Models\Category::where('status', 1)
    ->with(['subCategories' => function($query){
        $query->where('status', 1)
            ->with('childCategories', function($query){
                $query->where('status', 1);
            });
    }])
    ->get();
@endphp
<header>
    <!-- place navbar here -->
    <nav class="navbar navbar-expand-lg fw-bold p-1">
        <div class="container-fluid profile-navbar mx-0 mx-md-5">
            <div class="toggle-button">
                <button class="btn fs-3 text-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft" aria-controls="offcanvasTop"><i class="fa-solid fa-bars"></i></button>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="list-unstyled">
                            <li class="p-2"><a href="{{route('home')}}" class="dropdown-item d-block w-100 text-light fw-bold"><i class="fa-solid fa-house pe-2"></i>Home</a></li>
                            <li class="p-2"><a href="{{route('store')}}" class="dropdown-item d-block w-100 text-light fw-bold"><i class="fa-solid fa-store pe-2"></i>Store</a></li>
                            <li class="p-2"><a href="#" class="dropdown-item d-block w-100 text-light fw-bold"><i class="fa-solid fa-circle-info pe-2"></i>About</a></li>
                            <li class="p-2 dropdown-item">
                                <div class="dropdown">
                                    <div class="btn dropdown-item dropdown-toggle text-light fw-bold w-100 p-0 d-flex justify-content-between align-items-center border-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                      <span><i class="fa-solid fa-list pe-2"></i>Book Genre</span>
                                    </div>
                                    <ul class="dropdown-menu border-0 w-100 ps-2" aria-labelledby="dropdownMenuButton">
                                      @foreach ($categories as $category)
                                        @if (count($category->subCategories) > 0)
                                          <li>
                                            <a class="dropdown-item text-light fw-bold pe-0 d-flex justify-content-between align-items-center nested-dropdown" href="#">
                                              <span>{{$category->name}}</span>
                                              <i class="fa-solid fa-caret-down"></i>
                                            </a>
                                            <ul class="dropdown-menu dropdown-submenu border-0 ps-3">
                                              @foreach ($category->subCategories as $subCategory)
                                                @if (count($subCategory->childCategories) > 0)
                                                  <li>
                                                    <a class="dropdown-item text-light fw-bold pe-0 d-flex justify-content-between align-items-center nested-dropdown" href="#">
                                                      <span>{{$subCategory->name}}</span>
                                                      <i class="fa-solid fa-caret-down"></i>
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-submenu border-0 ps-4">
                                                      @foreach ($subCategory->childCategories as $childCategory)
                                                        <li><a class="dropdown-item text-light fw-bold" href="#">{{$childCategory->name}}</a></li>
                                                      @endforeach
                                                    </ul>
                                                  </li>
                                                @else
                                                  <li><a class="dropdown-item text-light fw-bold" href="#">{{$subCategory->name}}</a></li>
                                                @endif
                                              @endforeach
                                            </ul>
                                          </li>
                                        @else
                                          <li><a class="dropdown-item text-light fw-bold" href="#">{{$category->name}}</a></li>
                                        @endif
                                      @endforeach
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>                
            <a class="navbar-brand p-2 text-uppercase fs-4 text-light" href="">Booknest</a>
            <div class="d-none d-md-flex flex-row justify-content-center align-items-center navbar-item">
                <ul class="list-unstyled d-flex flex-row mb-0">
                    <li class="fs-5 p-2 px-4"><a href="{{route('home')}}" class="dropdown-item fw-bold text-light">Home</a></li>
                    <li class="fs-5 p-2 px-4"><a href="{{route('store')}}" class="dropdown-item fw-bold text-light">Store</a></li>
                    <li class="fs-5 p-2 px-4"><a href="#" class="dropdown-item fw-bold text-light">About</a></li>
                </ul>
            </div>
            <div class="d-flex">
                <div class="d-flex justify-content-center align-items-end my-auto mx-auto mx-md-3">
                  <a href="{{ route('cart-detail') }}">
                    <span class="position-relative">
                      <i class="fas fa-shopping-cart profile fs-4 text-white"></i>
                      @if (getCartCount()>0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill cart" id="cart-count">
                          {{getCartCount()}}
                        </span>
                      @endif
                    </span>
                  </a>
                </div>
                <div class="dropdown">
                    <button class="btn border-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-user profile text-light fs-4 p-2"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item fs-md-4 pe-5 text-light" href="{{route('user.dashboard')}}">Profile</a></li>
                        <li><a class="dropdown-item fs-md-4 pe-5 text-light" href="#">My Orders</a></li>
                        <li><a class="dropdown-item fs-md-4 pe-5 text-light" href="#">My adresses</a></li>
                        <hr class="m-0">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a class="dropdown-item text-decoration-none fs-md-4 pe-5 text-light" href="{{route('logout')}}" onclick="event.preventDefault();
                            this.closest('form').submit();">Sign Out</a>
                        </form> 
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>