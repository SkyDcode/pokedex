<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pokemon;
use App\Models\Type;
use App\Models\Attack;

class PokemonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Assurez-vous que les types existent avant d'exécuter ce seeder
        $waterType = Type::where('name', 'Water')->first();
        $fireType = Type::where('name', 'Fire')->first();
        $grassType = Type::where('name', 'Grass')->first();
        $electricType = Type::where('name', 'Electric')->first();

        // Assurez-vous que les attaques existent avant d'exécuter ce seeder
        $emberAttack = Attack::where('name', 'Ember')->first();
        $waterGunAttack = Attack::where('name', 'Water Gun')->first();
        $vineWhipAttack = Attack::where('name', 'Vine Whip')->first();
        $thunderShockAttack = Attack::where('name', 'Thunder Shock')->first();

        if ($waterType && $fireType && $grassType && $electricType && $emberAttack && $waterGunAttack && $vineWhipAttack && $thunderShockAttack) {
            // Création des Pokémon et association des attaques
            $pokemons = [
                [
                    'name' => 'PatiPat',
                    'pv' => 44,
                    'weight' => 90,
                    'height' => 5,
                    'type1_id' => $waterType->id,
                    'type2_id' => null,
                    'image' => 'storage\pokemons\Ppat.jpeg',
                    'attacks' => [$waterGunAttack->id],
                ],
                [
                    'name' => 'Enquetor',
                    'pv' => 39,
                    'weight' => 85,
                    'height' => 6,
                    'type1_id' => $fireType->id,
                    'type2_id' => null,
                    'image' => 'storage\pokemons\Penquetor.jpeg',
                    'attacks' => [$emberAttack->id],
                ],
                [
                    'name' => 'BadBanker',
                    'pv' => 45,
                    'weight' => 69,
                    'height' => 7,
                    'type1_id' => $grassType->id,
                    'type2_id' => $waterType->id,
                    'image' => 'storage\pokemons\Mbanker.jpeg',
                    'attacks' => [$vineWhipAttack->id],
                ],
                [
                    'name' => 'BossBazar',
                    'pv' => 35,
                    'weight' => 60,
                    'height' => 4,
                    'type1_id' => $electricType->id,
                    'type2_id' => null,
                    'image' => 'storage\pokemons\Mboss.jpeg',
                    'attacks' => [$thunderShockAttack->id],
                ],
                [
                    'name' => 'Volipan',
                    'pv' => 115,
                    'weight' => 55,
                    'height' => 5,
                    'type1_id' => $grassType->id,
                    'type2_id' => null,
                    'image' => 'storage\pokemons\Mbuglar.jpeg',
                    'attacks' => [$vineWhipAttack->id],
                ],
                [
                    'name' => 'Manifap',
                    'pv' => 40,
                    'weight' => 42,
                    'height' => 4,
                    'type1_id' => $fireType->id,
                    'type2_id' => null,
                    'image' => 'storage\pokemons\Pmanif.jpeg',
                    'attacks' => [$emberAttack->id],
                ],
                [
                    'name' => 'PokeCop',
                    'pv' => 50,
                    'weight' => 79,
                    'height' => 8,
                    'type1_id' => $waterType->id,
                    'type2_id' => null,
                    'image' => 'storage\pokemons\Ppokecop.jpeg',
                    'attacks' => [$waterGunAttack->id],
                ],
                [
                    'name' => 'Crimimiou',
                    'pv' => 55,
                    'weight' => 65,
                    'height' => 3,
                    'type1_id' => $grassType->id,
                    'type2_id' => null,
                    'image' => 'storage\pokemons\Mcriminou.webp',
                    'attacks' => [$vineWhipAttack->id],
                ],
            ];

            foreach ($pokemons as $pokemonData) {
                $pokemon = Pokemon::create([
                    'name' => $pokemonData['name'],
                    'pv' => $pokemonData['pv'],
                    'weight' => $pokemonData['weight'],
                    'height' => $pokemonData['height'],
                    'type1_id' => $pokemonData['type1_id'],
                    'type2_id' => $pokemonData['type2_id'],
                    'image' => $pokemonData['image'],
                ]);

                $pokemon->attacks()->attach($pokemonData['attacks']);
            }
        } else {
            // Gérer l'erreur si les types ou attaques n'existent pas
            throw new \Exception('Un ou plusieurs types ou attaques ne sont pas trouvés. Veuillez d\'abord peupler les types et attaques.');
        }
    }
}
