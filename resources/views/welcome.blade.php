<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Pokedex Cops</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body>
    <div class="navbar">
        <div>
            <!-- Your Logo Here -->
            <svg class="h-12 w-auto text-black lg:h-16 lg:text-[#FF2D20]" viewBox="0 0 62 65" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path d="..."/>
            </svg>
        </div>
        @if (Route::has('login'))
            <nav class="flex justify-end">
                @auth
                    <a href="{{ url('/dashboard') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">Register</a>
                    @endif
                @endauth
            </nav>
        @endif
    </div>

    <div class="flex-center position-ref full-height">
        <div class="content">
            <h1 class="mb-4 text-2xl font-semibold" style="color: red;">Bienvenue sur Pokedex Cops</h1>
            <form method="GET" action="{{ route('pokemon.publicsearch') }}">
                <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Recherchez des Pokémons</button>
            </form>
            <br/>
            <div class="pokemon-list">
                @foreach($pokemons as $pokemon)
                    <div class="pokemon-card scrolling">
                        <img src="{{ asset($pokemon->image) }}" alt="{{ $pokemon->name }}" class="pokemon-image">
                        <br/>
                        <div class="pokemon-details">
                            {{ $pokemon->name }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <footer class="footer">
       POKEDEX COPS 2024
    </footer>
</body>
</html>
