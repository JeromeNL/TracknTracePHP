<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Webshop;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class WebshopTest extends DuskTestCase
{


    public function testWebshopIndexCorrectPage(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visitRoute('webshops.index')
                ->assertSee('Webshop aanmaken')
                ->assertSee('ID')
                ->assertSee('Bedrijf')
                ->assertSee('Aanmaakdatum')
                ->assertSee('Meer');
        });
    }

    public function testWebshopCreateCorrectPage(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visitRoute('webshops.create')
                ->assertSee('Webshop aanmaken')
                ->assertSee('Adresgegevens')
                ->assertSee('Straat')
                ->assertSee('Huisnummer')
                ->assertSee('Postcode')
                ->assertSee('Plaats')
                ->assertSee('Land')
                ->assertSee('Contactgegevens')
                ->assertSee('Telefoonnummer')
                ->assertSee('E-mailadres')
                ->assertSee('Website');
        });
    }

    public function testWebshopCreate()
    {
        $webshop = Webshop::factory()->create();

        $this->browse(function (Browser $browser) use ($webshop) {
            $browser->loginAs(User::find(1));
            $browser->visitRoute('webshops.create');
            $browser->type('name', $webshop->name);
            $browser->type('street', 'Van de Bergstraat');
            $browser->type('number', '21');
            $browser->type('postal_code', '3128 CG');
            $browser->type('city', 'Eindhoven');
            $browser->type('country', 'Nederland');
            $browser->type('phone', '0632456789');
            $browser->type('email', $webshop->email);
            $browser->type('website', $webshop->website);
            $browser->press('Versturen');
            $browser->assertPathIs('/webshops');
            $browser->assertSee("De webshop is succesvol aangemaakt");
        });
    }

    public function testWebshopActionsDropdown()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $browser->visitRoute('webshops.index');
            $browser->click('td .dropdown-toggle');
            $browser->screenshot('webshop-actions-dropdown');
            $browser->assertSee('Details');
            $browser->assertSee('Bewerk');
            $browser->assertSee('Verwijder');
        });
    }


}
