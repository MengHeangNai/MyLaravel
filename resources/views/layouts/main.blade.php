<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1,
shrink-to-fit=no">
    <title>@yield('tittle', 'Contact App')</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?
family=Varela+Round">
    <!-- Style -->
    <link href="{{ asset('assets/bootstrap-icons/font/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container">
            <a class="navbar-brand text-uppercase" href="index.html">
                <strong><i class="bi bi-person-lines-fill me-1">
                    </i>Contact</strong> App
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle
navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    @auth
                        <li class="nav-item"><a href="#" class="nav-link">Companies</a></li>
                        <li class="nav-item active"><a href="#" class="nav-link">Contacts</a></li>
                    @endauth
                </ul>
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item mx-1"><a href="{{ route('login') }}" class="btn btn-outline-primary"><i
                                    class="bi bi-box-arrow-in-right me-1"> </i>Login</a></li>
                        <li class="nav-item mx-1"><a href="{{ route('register') }}" class="btn btn-outline-primary"><i
                                    class="bi bi-person-plus-fill me-1"> </i></i>Register</a></li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">Settings</a>
                                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button class="dropdown-item">Logout</button>
                                </form>
                            </div>

                        </li>
                    @endguest

                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
