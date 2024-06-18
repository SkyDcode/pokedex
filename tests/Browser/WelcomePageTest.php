<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class WelcomePageTest extends DuskTestCase
{
    /** @test */
    public function homepage_loads_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Bienvenue sur Pokedex Cops');
        });
    }

    /** @test */
    public function it_can_navigate_to_public_search_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Recherchez des Pokémons')
                    ->assertPathIs('/publicsearch');
        });
    }
}
