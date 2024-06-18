<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'color'];

    public function pokemons()
    {
        return $this->hasMany(Pokemon::class, 'type1_id');
    }

    public function secondaryPokemons()
    {
        return $this->hasMany(Pokemon::class, 'type2_id');
    }
}
