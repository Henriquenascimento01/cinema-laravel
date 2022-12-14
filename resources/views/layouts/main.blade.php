<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonte do Google -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- CSS/JavaScript da aplicação -->
    <link rel="stylesheet" href="/css/style.css">
    <script src="/js/scripts.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="collapse navbar-collapse" id="navbar">
                <a href="/" class="navbar-brand">
                    <img src="/img/logocinemapreta.jpg" alt="Logo">
                </a>

                <ul class="navbar-nav">

                    @guest
                        <li class="nav-item">
                            <a href="/" class="nav-link">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('all-sessions') }}" class="nav-link">Sessões</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('login-form') }}" class="nav-link">Entrar</a>
                        </li>
                    @endguest

                    @auth
                        <li class="nav-item">
                            <a href="/" class="nav-link">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('all-sessions') }}" class="nav-link">Sessões</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('rooms-index') }}" class="nav-link">Salas</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('movies-index') }}" class="nav-link">Filmes</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('classifications-index') }}" class="nav-link">Classificações</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tags-index') }}" class="nav-link">Gêneros</a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Sair</a>
                        </li>
                    @endauth

                </ul>

                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="d-none">
                    @csrf
                </form>
            </div>
        </nav>
    </header>
    <main>
        <div class="container-fluid">
            <div class="mt-5">

                {{-- @if (session('msg-error'))
                    <div class="alert alert-danger">
                        {{ session('msg-error') }}
                    </div>
                @endif --}}

                {{-- @if ($errors->any())
                    <ul class="error">
                        @foreach ($errors->all() as $error)
                            <li class="alert alert-danger">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                @endif --}}

                @yield('content')

            </div>
        </div>
    </main>
    <footer>
        <p>Cinema &copy; 2022</p>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </footer>
</body>

</html>
