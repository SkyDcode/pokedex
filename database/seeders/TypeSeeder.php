<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            ['name' => 'Water', 'color' => 'blue'],
            ['name' => 'Fire', 'color' => 'red'],
            ['name' => 'Grass', 'color' => 'green'],
            ['name' => 'Electric', 'color' => 'yellow'],
            ['name' => 'Ice', 'color' => 'lightblue'],
        ];

        foreach ($types as $type) {
            Type::create($type);
        }
    }
}
