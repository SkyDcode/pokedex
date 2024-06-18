<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pokemon extends Model
{
    use HasFactory;

    protected $table = 'pokemons';

    protected $fillable = [
        'name',
        'pv',
        'weight',
        'height',
        'type1_id',
        'type2_id',
        'image',
    ];

    public function type1()
    {
        return $this->belongsTo(Type::class, 'type1_id');
    }

    public function type2()
    {
        return $this->belongsTo(Type::class, 'type2_id');
    }

    public function attacks()
    {
        return $this->belongsToMany(Attack::class, 'pokemon_attack', 'pokemon_id', 'attack_id');
    }
}
