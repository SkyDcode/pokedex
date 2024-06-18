<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attack;
use App\Models\Type;

class AttackController extends Controller
{
    public function index()
    {
        $attacks = Attack::with('type')->get();
        return view('attacks.index', compact('attacks'));
    }

    public function create()
    {
        $types = Type::all();
        return view('attacks.create', compact('types'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'damage' => 'required|integer',
            'type_id' => 'required|exists:types,id',
        ]);

        Attack::create($request->all());

        return redirect()->route('attacks.index')->with('success', 'Attaque créée avec succès');
    }

    public function edit($id)
    {
        $attack = Attack::findOrFail($id);
        $types = Type::all();
        return view('attacks.edit', compact('attack', 'types'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'damage' => 'required|integer',
            'type_id' => 'required|exists:types,id',
        ]);

        $attack = Attack::findOrFail($id);
        $attack->update($request->all());

        return redirect()->route('attacks.index')->with('success', 'Attaque mise à jour avec succès');
    }

    public function destroy($id)
    {
        $attack = Attack::findOrFail($id);
        $attack->delete();

        return redirect()->route('attacks.index')->with('success', 'Attaque supprimée avec succès');
    }
}
