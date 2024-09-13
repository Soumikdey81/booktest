{{-- <x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Booknest Reset Password Page</title>
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
    <!--toastr css-->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('frontend/css/index.css')}}">
</head>
<body>
    <header>
        <!-- place navbar here -->
    </header>
    <main>
        <div class="row m-0 user_auth">
            <div class="col-md-4 p-5 d-flex justify-content-center align-items-center">
                <div>
                    <h1 class="user-header fw-bold">Reset Password</h1>
                    <img class="logo" src="{{asset('frontend/photo/logo.png')}}" alt="">
                </div>
            </div>
            <div class="col-md-8 p-4 d-flex justify-content-center align-items-center">
                <div class="border border-1 p-4 user_form rounded-3 user-box">
                    <form method="POST" action="{{ route('password.store') }}" class="myform">
                        @csrf              
                        <!-- Password Reset Token -->
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="form-group user_input mb-2">
                            <label class="mb-1 cart-header fw-bold" for="email">Email</label>
                            <br>
                            <input class="w-100 fw-bold cart-text rounded-3 px-2 py-1 border border-light" type="email" id="email" name="email" value="{{old('email', $request->email)}}" placeholder="Email">
                        </div>
                        <div class="form-group user_input mb-2">
                            <label class="mb-1 cart-header fw-bold" for="password">Password</label>
                            <br>
                            <input class="w-100 fw-bold cart-text rounded-3 px-2 py-1 border border-light" id="password" type="password" name="password" placeholder="Password">
                        </div>
                        <div class="form-group user_input mb-2">
                            <label class="mb-1 cart-header fw-bold" for="password_confirmation">Confirm Password</label>
                            <br>
                            <input class="w-100 fw-bold cart-text rounded-3 px-2 py-1 border border-light" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                        <button type="submit" class="common_btn w-100 mt-2 fw-bold button border-0 rounded-3">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
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
    <!--toastr js-->
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    
    <script>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{$error}}")
        @endforeach
        @endif
    </script>
</body>
</html>