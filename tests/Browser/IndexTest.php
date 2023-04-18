<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class IndexTest extends DuskTestCase
{

    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Welkom!');
        });
    }

    public function testLanguage(): void
    {
        $this->browse(function ($browser) {
            $browser->click('#current_language')
                ->assertSee('Duits');
        });
    }
}
