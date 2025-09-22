<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Home')</title>
        <link href="{{ asset('assets/css/client.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">




</head>

<body>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">National Care</a>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                    <i class="bi bi-cart3" style="font-size: 1.5rem;"></i>
                    @if($cartCount > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $cartCount > 9 ? '9+' : $cartCount }}
                        </span>
                       
                        @else
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ 0 }}
                        </span>
                    @endif
                </a>
            </li>
        </ul>
    </div>
</nav>


    <main class="container mt-4">
        @yield('content')
    </main>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-+b3GQ5uDkLMwMfqYg+yuvJqZfN3cP/4TtB/7jlvYI2w=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    <!-- Toastify JS for notifications -->
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
</body>

</html>