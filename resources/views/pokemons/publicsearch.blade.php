<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Public Search</title>
    <link rel="stylesheet" href="{{ asset('css/search.css') }}">
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ route('welcome') }}" class="btn btn-primary">Accueil</a>
            <h1>Rechercher des Pokémon</h1>
            <form method="GET" action="{{ route('pokemon.publicsearch') }}" class="search-form">
                <input type="text" name="query" placeholder="Entrez le nom du Pokémon" value="{{ request('query') }}">
                <select name="type" class="form-select">
                    <option value="">Tous les types</option>
                    @foreach($types as $type)
                        <option value="{{ $type->name }}" {{ request('type') == $type->name ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
                <button type="submit">Rechercher</button>  
            </form>
        </div>
        @if(isset($pokemons) && count($pokemons) > 0)
            <div class="pokemon-list">
                @foreach($pokemons as $pokemon)
                    <div class="pokemon-card relative">
                        <img src="{{ asset($pokemon->image) }}" alt="{{ $pokemon->name }}">
                        <div class="type-badge type-{{ strtolower($pokemon->type1->name) }}">
                            {{ $pokemon->type1 ? $pokemon->type1->name : 'Type inconnu' }}
                        </div>
                        <h3>{{ $pokemon->name }}</h3>
                        <p>PV: {{ $pokemon->pv }}</p>
                        <p>Poids: {{ $pokemon->weight }} kg</p>
                        <p>Taille: {{ $pokemon->height }} m</p>
                        <p>Type 1: {{ $pokemon->type1 ? $pokemon->type1->name : 'Non spécifié' }}</p>
                        <p>Type 2: {{ $pokemon->type2 ? $pokemon->type2->name : 'Non spécifié' }}</p>
                        <p>Attaques: {{ $pokemon->attacks->pluck('name')->join(', ') }}</p>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center">Aucun Pokémon trouvé.</p>
        @endif
    </div>
</body>
</html>
