<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PokemonController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AttackController;
use App\Http\Controllers\TypeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

Route::get('/publicsearch', [PokemonController::class, 'publicSearch'])->name('pokemon.publicsearch');
Route::get('/search', [PokemonController::class, 'search'])->name('pokemon.search');
Route::get('/pokemons/create', [PokemonController::class, 'create'])->name('pokemons.create');
Route::post('/pokemons', [PokemonController::class, 'store'])->name('pokemons.store');
Route::get('/pokemons/{id}/edit', [PokemonController::class, 'edit'])->name('pokemons.edit');
Route::patch('/pokemons/{id}', [PokemonController::class, 'update'])->name('pokemons.update');
Route::delete('/pokemons/{id}', [PokemonController::class, 'destroy'])->name('pokemons.destroy');

Route::resource('pokemons', PokemonController::class);
Route::resource('attacks', AttackController::class);

Route::resource('types', TypeController::class);

Route::get('/dashboard', [PokemonController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



