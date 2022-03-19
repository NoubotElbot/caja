<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/volt.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">

</head>

<body>
    @auth
        <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
            <a class="navbar-brand me-lg-5" href="/">
                {{-- <img class="navbar-brand-dark" src="../../assets/img/brand/light.svg" alt="Volt logo" /> --}}
            </a>
            <div class="d-flex align-items-center">
                <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>

        <nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
            <div class="sidebar-inner px-4 pt-3">
                <div
                    class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
                    <div class="d-flex align-items-center">
                        <div class="avatar-lg me-4">
                            <img src="{{ asset('img/descarga.png') }}" class="card-img-top rounded-circle border-white"
                                alt="User">
                        </div>
                        <div class="d-block">
                            <h2 class="h5 mb-3">Hola, {{ auth()->user()->name }}</h2>

                            <a class="btn btn-secondary btn-sm d-inline-flex align-items-center"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewbox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                    </path>
                                </svg>
                                Salir
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <div class="collapse-close d-md-none">
                        <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                            aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                            <svg class="icon icon-xs" fill="currentColor" viewbox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <ul class="nav flex-column pt-3 pt-md-0">
                    <li class="nav-item">
                        <a href="/" class="nav-link d-flex align-items-center">
                            <span class="sidebar-icon">
                                {{-- <img src="../../assets/img/brand/light.svg" height="20" width="20" alt="Volt Logo"> --}}
                            </span>
                            <span class="mt-1 ms-1 sidebar-text">Caja</span>
                        </a>
                    </li>
                    <li @class([
                        'nav-item',
                        'active' => ($view ?? null) == 'productos',
                    ])>
                        <a href="{{ route('productos.index') }}" class="nav-link">
                            <span class="sidebar-icon">
                                <i class="fas fa-boxes"></i>

                            </span>
                            <span class="sidebar-text">Productos</span>
                        </a>
                    </li>
                    <li @class([
                        'nav-item',
                        'active' => ($view ?? null) == 'usuarios',
                    ])>
                        <a href="{{ route('usuarios.index') }}" class="nav-link">
                            <span class="sidebar-icon">
                                <i class="fas fa-users"></i>
                            </span>
                            <span class="sidebar-text">Usuarios</span>
                        </a>
                    </li>
                    <li @class([
                        'nav-item',
                        'active' => ($view ?? null) == 'ventas',
                    ])>
                        <a href="{{ route('ventas.index') }}" class="nav-link">
                            <span class="sidebar-icon">
                                <i class="fas fa-cash-register"></i>
                            </span>
                            <span class="sidebar-text">Ventas</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    @endauth
    <main class="@auth content
@else
container @endauth">
        @auth
            <nav class="d-none d-lg-block navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
                <div class="container-fluid px-0">
                    <div class="d-flex justify-content-end w-100" id="navbarSupportedContent">
                        <!-- Navbar links -->
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item dropdown ms-lg-3">
                                <a class="nav-link dropdown-toggle pt-1 px-0" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="media d-flex align-items-center">
                                        <img class="avatar rounded-circle" alt="Image placeholder"
                                            src="{{ asset('img/descarga.png') }}">
                                        <div class="media-body ms-2 text-dark align-items-center d-none d-lg-block">
                                            <span
                                                class="mb-0 font-small fw-bold text-gray-900">{{ auth()->user()->name }}</span>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu dashboard-dropdown dropdown-menu-end mt-2 py-1">
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <svg class="dropdown-icon text-danger me-2" fill="none" stroke="currentColor"
                                            viewbox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                            </path>
                                        </svg>
                                        Salir
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        @endauth

        @yield('content')
    </main>

    @yield('scripts')
</body>

</html>
