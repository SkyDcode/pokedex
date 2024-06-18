<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Liste des Types') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('types.create') }}" class="btn btn-success bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Créer un nouveau type</a> <br>
                        <br>
                    </div>
                  
                    <ul class="list-disc pl-5">
                        @foreach($types as $type)
                            <li class="mb-2">
                                {{ $type->name }} - Couleur: {{ $type->color }}
                                <a href="{{ route('types.edit', $type->id) }}" class="btn btn-warning ml-2">Modifier</a>
                                <form action="{{ route('types.destroy', $type->id) }}" method="POST" class="inline ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">
                                        Supprimer
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
