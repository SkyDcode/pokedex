@extends('layouts.app')

@section('content')
    <h1>Liste des Attaques</h1>
    <a href="{{ route('attacks.create') }}">Créer une nouvelle attaque</a>
    <ul>
        @foreach($attacks as $attack)
            <li>{{ $attack->name }} ({{ $attack->damage }} damage)</li>
        @endforeach
    </ul>
@endsection
