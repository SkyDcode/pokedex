<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Attack;
use App\Models\Type;

class AttackSeeder extends Seeder
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

        if ($waterType && $fireType && $grassType && $electricType) {
            Attack::create(['name' => 'Water Gun', 'damage' => 40, 'type_id' => $waterType->id]);
            Attack::create(['name' => 'Ember', 'damage' => 40, 'type_id' => $fireType->id]);
            Attack::create(['name' => 'Vine Whip', 'damage' => 45, 'type_id' => $grassType->id]);
            Attack::create(['name' => 'Thunder Shock', 'damage' => 40, 'type_id' => $electricType->id]);
        } else {
            throw new \Exception('Un ou plusieurs types ne sont pas trouvés. Veuillez d\'abord peupler les types.');
        }
    }
}
