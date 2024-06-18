<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $pokemons = Pokemon::all();
        return view('welcome', compact('pokemons'));
    }
}
