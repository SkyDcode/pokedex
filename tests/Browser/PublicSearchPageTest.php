<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\Type;

class PublicSearchPageTest extends DuskTestCase
{
    /** @test */
    public function public_search_page_loads_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/publicsearch')
                    ->assertSee('Rechercher des Pokémon');
        });
    }

    /** @test */
    public function it_can_search_pokemon_by_name()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/publicsearch')
                    ->type('query', 'PatiPat')
                    ->press('Rechercher')
                    ->assertSee('PatiPat');
        });
    }

    /** @test */
    public function it_can_filter_pokemon_by_type()
    {
        // Create a type to test with
        $type = Type::create(['name' => 'Water', 'color' => '#0000FF']);

        $this->browse(function (Browser $browser) use ($type) {
            $browser->visit('/publicsearch')
                    ->select('type', 'Water')
                    ->press('Rechercher')
                    ->assertSee('Water');
        });
    }

    /** @test */
    public function it_shows_no_pokemon_found_message_when_no_pokemon()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/publicsearch')
                    ->type('query', 'NonExistentPokemon')
                    ->press('Rechercher')
                    ->assertSee('Aucun Pokémon trouvé.');
        });
    }
}
