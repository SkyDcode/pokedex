<x-app-layout>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <h1 class="mb-4 text-2xl font-semibold">Rechercher des Pokémon</h1>
                    <form method="GET" action="{{ route('pokemon.search') }}" class="flex space-x-4">
                        <div class="flex-1">
                            <input type="text" name="query" class="form-input rounded-md shadow-sm mt-1 block w-full" placeholder="Entrez le nom du Pokémon" value="{{ request('query') }}">
                        </div>
                        <div>
                            <select name="type" class="form-select rounded-md shadow-sm mt-1 block w-full">
                                <option value="">Tous les types</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->name }}" {{ request('type') == $type->name ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Rechercher
                            </button>
                        </div>
                    </form>

                    <div class="mt-4">
                        <a href="{{ route('pokemons.create') }}" class="btn btn-success bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            Ajouter un Pokémon
                        </a>
                    </div>

                    @if(isset($pokemons))
                        <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($pokemons as $pokemon)
                                <div class="bg-white shadow-md rounded-lg overflow-hidden border-2 border-gray-200 relative">
                                    <div class="relative h-48">
                                        <img src="{{ asset($pokemon->image) }}" alt="{{ $pokemon->name }}" class="w-full h-full object-cover">
                                    </div>
                                    <div class="p-4">
                                        <h3 class="text-xl font-bold text-gray-800">{{ $pokemon->name }}</h3>
                                        <p class="text-sm text-gray-600">PV: {{ $pokemon->pv }}</p>
                                        <p class="text-sm text-gray-600">Poids: {{ $pokemon->weight }} kg</p>
                                        <p class="text-sm text-gray-600">Taille: {{ $pokemon->height }} m</p>
                                        <p class="text-sm text-gray-600">Type 1: {{ $pokemon->type1 ? $pokemon->type1->name : 'Non spécifié' }}</p>
                                        @if($pokemon->type2)
                                            <p class="text-sm text-gray-600">Type 2: {{ $pokemon->type2 ? $pokemon->type2->name : 'Non spécifié' }}</p>
                                        @endif
                                        <p class="text-sm text-gray-600">Attaques: {{ $pokemon->attacks->pluck('name')->join(', ') }}</p>
                                        <div class="mt-4 flex justify-between items-center">
                                            <a href="{{ route('pokemons.edit', $pokemon->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded">Modifier</a>
                                            <form action="{{ route('pokemons.destroy', $pokemon->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Supprimer</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="absolute top-2 right-2 type-badge type-{{ strtolower($pokemon->type1->name) }}">
                                        {{ $pokemon->type1 ? $pokemon->type1->name : 'Type inconnu' }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
