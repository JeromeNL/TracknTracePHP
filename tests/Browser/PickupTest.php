<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PickupTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/pickups')
                ->assertSee('Plan een ophaalmoment');
        });
    }

    public function testRequestPickup()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/pickups')
                ->type('#start_date', date('d-m-Y'))
                ->type('#start_time', date('H:i'))
                ->click('input[type="submit"]')
                ->assertSee('Je bent te laat met een ophaalmoment aanvragen. Dit moet minimaal 2 dagen van tevoren, hooguit om 15.00');
        });
    }
}
