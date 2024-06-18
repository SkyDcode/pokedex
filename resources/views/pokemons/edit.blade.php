<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier un Pokémon') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="mb-4">
                            <ul class="list-disc list-inside text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('pokemons.update', $pokemon->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-label for="name" :value="__('Nom')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $pokemon->name) }}" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="pv" :value="__('Points de vie (PV)')" />
                            <x-input id="pv" class="block mt-1 w-full" type="number" name="pv" value="{{ old('pv', $pokemon->pv) }}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="weight" :value="__('Poids')" />
                            <x-input id="weight" class="block mt-1 w-full" type="number" name="weight" value="{{ old('weight', $pokemon->weight) }}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="height" :value="__('Taille')" />
                            <x-input id="height" class="block mt-1 w-full" type="number" name="height" value="{{ old('height', $pokemon->height) }}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="type1_id" :value="__('Type 1')" />
                            <select id="type1_id" name="type1_id" class="block mt-1 w-full" required>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ $type->id == $pokemon->type1_id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="type2_id" :value="__('Type 2 (optionnel)')" />
                            <select id="type2_id" name="type2_id" class="block mt-1 w-full">
                                <option value="">{{ __('Aucun') }}</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ $type->id == $pokemon->type2_id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="attacks" :value="__('Attaques')" />
                            <select id="attacks" name="attacks[]" class="block mt-1 w-full" multiple>
                                @foreach ($attacks as $attack)
                                    <option value="{{ $attack->id }}" {{ in_array($attack->id, $pokemon->attacks->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $attack->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-label for="image" :value="__('Image')" />
                            <x-input id="image" class="block mt-1 w-full" type="file" name="image" />
                        </div>
                        
                        @if($pokemon->image)
                            <div class="mt-2">
                                <img src="{{ asset($pokemon->image) }}" alt="{{ $pokemon->name }}" class="w-32 h-32 object-cover">
                            </div>
                        @endif

                        <div class="mt-4">
                            <x-button>
                                {{ __('Mettre à jour le Pokémon') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
