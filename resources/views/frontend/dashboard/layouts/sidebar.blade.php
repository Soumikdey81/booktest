<div class="col-auto w-auto pt-3 sidebar col-md-4">
    <p class="text-light cart-header fw-bold text-center border border-light p-2 ps-0 m-0">Profile Menu</p>
    <ul class="list-unstyled">
        <li class="p-2"><a href="{{route('user.dashboard')}}" class="text-decoration-none cart-text d-block w-100 text-light fw-bold"><i class="fas fa-home pe-2"></i>Home</a></li>
        <li class="p-2"><a href="#" class="text-decoration-none cart-text d-block w-100 text-light fw-bold"><i class="fas fa-user pe-2"></i>Profile</a></li>
        <li class="p-2"><a href="{{route('user.orders.index')}}" class="text-decoration-none cart-text d-block w-100 text-light fw-bold"><i class="fas fa-list pe-2"></i>My Orders</a></li>
        <li class="p-2"><a href="{{route('user.address.index')}}" class="text-decoration-none cart-text d-block w-100 text-light fw-bold"><i class="fas fa-gift pe-2"></i>My Addresses</a></li>
        <li class="p-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <div class="d-flex align-items-center">
                    <i class="fas fa-sign-out text-light pe-2"></i>
                    <a href="{{route('logout')}}" onclick="event.preventDefault();
                    this.closest('form').submit();" class="d-block w-100 fw-bold text-decoration-none cart-text text-light">Sign Out</a>
                </div>
            </form> 
        </li>
    </ul>
</div>