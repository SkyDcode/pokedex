<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Créer une Attaque') }}
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
                    <form method="POST" action="{{ route('attacks.store') }}">
                        @csrf
                        <div>
                            <x-label for="name" :value="__('Nom')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="damage" :value="__('Dégâts')" />
                            <x-input id="damage" class="block mt-1 w-full" type="number" name="damage" value="{{ old('damage') }}" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="type_id" :value="__('Type')" />
                            <select id="type_id" name="type_id" class="block mt-1 w-full" required>
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-button>
                                {{ __('Ajouter Attaque') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
