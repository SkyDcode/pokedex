<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier un Type') }}
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
                    <form method="POST" action="{{ route('types.update', $type->id) }}">
                        @csrf
                        @method('PATCH')
                        <div>
                            <x-label for="name" :value="__('Nom')" />
                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $type->name) }}" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-label for="color" :value="__('Couleur')" />
                            <x-input id="color" class="block mt-1 w-full" type="text" name="color" value="{{ old('color', $type->color) }}" required />
                        </div>

                        <div class="mt-4">
                            <x-button>
                                {{ __('Mettre à jour le Type') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
