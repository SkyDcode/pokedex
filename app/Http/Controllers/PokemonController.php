<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pokemon;
use App\Models\Type;
use App\Models\Attack;
use Illuminate\Support\Facades\Storage;

class PokemonController extends Controller
{
  
    public function create()
    {
        $types = Type::all();
        $attacks = Attack::all();
        return view('pokemons.create', compact('types', 'attacks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'pv' => 'required|integer',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'type1_id' => 'required|exists:types,id',
            'type2_id' => 'nullable|exists:types,id',
            'attacks' => 'required|exists:attacks,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->type1_id === $request->type2_id) {
            return back()->withErrors(['type2_id' => 'Type 1 and Type 2 cannot be the same.'])->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $imagePath = 'images/' . $filename;
        }

        $pokemon = Pokemon::create([
            'name' => $request->name,
            'pv' => $request->pv,
            'weight' => $request->weight,
            'height' => $request->height,
            'type1_id' => $request->type1_id,
            'type2_id' => $request->type2_id,
            'image' => $imagePath,
        ]);

        $pokemon->attacks()->attach($request->attacks);

        return redirect()->route('dashboard')->with('success', 'Pokémon ajouté avec succès');
    }

    public function edit($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        $types = Type::all();
        $attacks = Attack::all();
        return view('pokemons.edit', compact('pokemon', 'types', 'attacks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'pv' => 'required|integer',
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'type1_id' => 'required|exists:types,id',
            'type2_id' => 'nullable|exists:types,id',
            'attacks' => 'required|exists:attacks,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->type1_id === $request->type2_id) {
            return back()->withErrors(['type2_id' => 'Type 1 et Type 2 doivent être différents'])->withInput();
        }

        $pokemon = Pokemon::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($pokemon->image) {
                Storage::delete('public/' . $pokemon->image);
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $pokemon->image = 'images/' . $filename;
        }

        $pokemon->update([
            'name' => $request->name,
            'pv' => $request->pv,
            'weight' => $request->weight,
            'height' => $request->height,
            'type1_id' => $request->type1_id,
            'type2_id' => $request->type2_id,
            'image' => $pokemon->image,
        ]);

        $pokemon->attacks()->sync($request->attacks);

        return redirect()->route('dashboard')->with('success', 'Pokémon mis à jour avec succès');
    }

    public function destroy($id)
    {
        $pokemon = Pokemon::findOrFail($id);

        if ($pokemon->image) {
            Storage::delete('public/' . $pokemon->image);
        }

        $pokemon->delete();

        return redirect()->route('dashboard')->with('success', 'Pokémon supprimé avec succès');
    }

    public function search(Request $request)
    {
        $query = Pokemon::query();
    
        if ($request->has('query') && $request->input('query') !== '') {
            $search = $request->input('query');
            $query->where('name', 'LIKE', "%{$search}%");
        }
    
        if ($request->has('type') && $request->input('type') !== '') {
            $type = $request->input('type');
            $query->whereHas('type1', function ($q) use ($type) {
                $q->where('name', 'LIKE', "%{$type}%");
            });
        }
    
        $pokemons = $query->get();
        $types = Type::all();  // Assurez-vous que cette ligne est présente
    
        return view('dashboard', compact('pokemons', 'types'));
    }
    
    public function dashboard()
    {
        $pokemons = Pokemon::all();
        $types = Type::all();  // Assurez-vous que cette ligne est présente
    
        return view('dashboard', compact('pokemons', 'types'));
    }
    

    public function publicSearch(Request $request)
    {
        $query = Pokemon::query();

        if ($request->has('query')) {
            $search = $request->input('query');
            $query->where('name', 'LIKE', "%{$search}%");
        }
    
        if ($request->has('type') && $request->input('type') !== '') {
            $type = $request->input('type');
            $query->whereHas('type1', function ($q) use ($type) {
                $q->where('name', 'LIKE', "%{$type}%");
            });
        }
    
        $pokemons = $query->get();
        $types = Type::all(); 
    
        return view('pokemons.publicsearch', compact('pokemons', 'types'));
    }
}
