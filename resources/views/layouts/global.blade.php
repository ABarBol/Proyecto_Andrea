<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite('resources/js/app.js')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @yield('headContent')

</head>

<body>
    <div class="container-fluid p-0">
        <!--header -->
        <header class="container-fluid sticky-top p-0 mb-3">
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
                <a class="navbar-brand ms-3" href="{{ route('home.show') }}"><i class="fa-regular fa-calendar"></i>
                    Scheduly</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#navbarOffcanvasLg" aria-controls="navbarOffcanvasLg"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="navbarOffcanvasLg"
                    aria-labelledby="navbarOffcanvasLgLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3 align-items-center">
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::currentRouteName() === 'home.show' ? 'active' : '' }}"
                                        aria-current="page" href="{{ route('home.show') }}"><i
                                            class="fa-solid fa-house"></i></a>
                                </li>
                            @endguest
                            @auth
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::currentRouteName() === 'users.show' ? 'active' : '' }}"
                                        aria-current="page" href="{{ route('users.show', Auth::user()) }}"><i
                                            class="fa-solid fa-house"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Route::currentRouteName() === 'users.index' ? 'active' : '' }}"
                                        href="{{ route('users.index') }}"><i class="fa-solid fa-users"></i></a>
                                </li>
                            @endauth
                            @if (Auth::user()->admin)
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteName() === 'groups.index' ? 'active' : '' }}"
                                    href="{{ route('groups.index') }}"><i class="fa-solid fa-users-viewfinder"></i></a>
                            </li>
                            @endif
                        </ul>
                        <ul class="navbar-nav justify-content-end flex-grow-1 pt-5 pt-md-0 pe-3 align-items-center ">
                            @if (!Auth::check())
                                <li class="nav-item p-1">
                                    <a class="btn btn-primary btn-block" role="button" href="{{ route('login') }}">Log
                                        in</a>
                                </li>
                                <li class="nav-item p-1">
                                    <a class="btn btn-outline-secondary btn-block" role="button"
                                        href="{{ route('register') }}">Registrarse</a>
                                </li>
                            @else
                                <li class="nav-item p-1">
                                    <a class="btn btn-danger btn-block" role="button" href="{{ route('logout') }}">Log
                                        out</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main role="main" class="container main-container">
            @yield('content')
        </main>
        <aside role="aside" class="container">
            <div class="pb-2 border-bottom"></div>
            <div class="row d-flex justify-content-center p-4">
                <img src="https://ximg.es/1000x300/000/fff" class="img-fluid" alt="Responsive image">
            </div>
        </aside>
        <footer class="footer mt-auto py-3 bg-light">
            <div class="container">
                <span class="text-muted">@ Andrea Barros Bólico</span>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/4bbae93c2b.js" crossorigin="anonymous"></script>
</body>

</html>
