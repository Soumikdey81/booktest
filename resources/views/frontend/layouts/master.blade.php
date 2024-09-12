<!doctype html>
<html lang="en">
    <head>
        <title>
            @yield('title')
        </title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
        <link rel="stylesheet" href="{{asset('frontend/css/index.css')}}">
        <!--font-awesome css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!--toastr css-->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <!--swiper css-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200..700&display=swap" rel="stylesheet">
    </head>

    <body>
        @include('frontend.layouts.header')

        @yield('content')

        <div class="question rounded-2 overflow-hidden">
            <div class="question-sign">
              <i class="fa-solid fa-question cart-header text-white"></i>
            </div>
            <div class="hidden-text">
              <a href="#" class="text-white fw-bold cart-text text-decoration-none">Can't find what you are looking for?</a>
              <br>
              <a href="#" class="text-white fw-bold cart-text text-decoration-none">Enquiry & Feedback</a>
            </div>
        </div>

        @include('frontend.layouts.footer')
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{asset('frontend/js/style.js')}}"></script>
        <!--toastr js-->
        <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <!-- sweet alert js link -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!--swiper js product detail image slider -->
        <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
        <script>
            let swiper = new Swiper('.swiper', {
                slidesPerView: 1,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                speed: 1000,
            });
        </script>
        <!--error toastr js script -->
        <script>
          @if ($errors->any())
            @foreach ($errors->all() as $error)
              toastr.error("{{$error}}")
            @endforeach
          @endif
        </script>
        <script>
            setInterval(function(){
                getCartCount();
            }, 5000);
            //count total cart product dynamically
            function getCartCount(){
                $.ajax({
                    method: 'GET',
                    url: "{{route('cart-count')}}",
                    success: function(data){
                        console.log(data);
                        $('#cart-count').text(data);
                    },
                    error: function(xhr, status, error){
                        
                    }
                })
            }
        </script>
        @stack('scripts')
    </body>
</html>
