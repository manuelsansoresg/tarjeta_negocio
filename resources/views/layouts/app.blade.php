<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $profile = \App\Models\BusinessProfile::first();
        $primary = $profile->primary_color ?? '#c62828';
        $secondary = $profile->secondary_color ?? '#0d6efd';
        // Fondo rosado por defecto para alinearse con el diseño solicitado
        $bg = $profile->background_color ?? '#f7d7da';
        $title = $profile->title ?? config('app.name', 'Tarjeta de Negocio');
        $logo = $profile->logo_path ?? asset('images/logo.png');
    @endphp
    <title>{{ $title }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        :root{ --primary: {{ $primary }}; --secondary: {{ $secondary }}; --bg: {{ $bg }}; }
        /* Fondo rosado y texto oscuro para mejorar contraste con el nuevo tema */
        body{ background: var(--bg); color:#2b1f1f; font-family: 'Poppins', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, 'Noto Sans', 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; }
        .brand-logo{ width:32px; height:32px; border-radius:50%; object-fit:cover; }
        .navbar-gradient{ background: linear-gradient(90deg, var(--secondary), var(--primary)); }
    </style>
</head>
<body>
    <div id="app">
        @auth
        <nav class="navbar navbar-expand-md navbar-dark navbar-gradient shadow-sm">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/admin') }}">
                    <img src="{{ $logo }}" class="brand-logo" alt="logo">
                    <span>{{ $title }}</span>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto"></ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Cerrar sesión') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none"> @csrf </form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @endauth

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
