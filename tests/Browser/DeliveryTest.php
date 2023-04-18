<?php

namespace Tests\Browser;

use App\Models\Delivery;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;


class DeliveryTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testDeliveriesPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/deliveries')
                ->assertSee('Jouw verzendingen');
        });

    }

    public function testImportDeliveriesButtonRedirectsToCorrectUrl()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/deliveries')
                ->waitFor('#import_button')
                ->click('#import_button')
                ->assertPathIs('/deliveries/import');
        });
    }

    public function testPrintLabelsButtonRedirectsToCorrectUrl()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/deliveries')
                ->waitFor('#multiple_labels_button')
                ->click('#multiple_labels_button')
                ->assertPathIs('/deliveries/print-labels');
        });
    } // dropdown_button

    public function testDetailsButtonRedirectsToCorrectUrl()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/deliveries')
                ->click('#dropdown_button')
                ->waitFor('#dropdown_details')
                ->click('#dropdown_details')
                ->assertPathIs('/deliveries/1');
        });
    }

    public function testImportDeliveriesPageHasRequiredFields()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/deliveries/import')
                ->assertSee('Vereiste waarden');
        });
    }

    /** @test */
    public function testImportDeliveriesForm()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/deliveries/import')
                ->attach('file', 'tests/data/Deliveries_1.xlsx') // replace with path to a test CSV file
                ->press('#import_button')
                ->assertPathIs('/deliveries'); // replace with the expected redirect URL
        });
    }

    public function testImportDeliversFormIncorrectFile()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/deliveries/import')
                ->attach('file', 'tests/data/Deliveries_2.xlsx')
                ->press('#import_button')
                ->assertPathIs('/deliveries/import')
                ->assertSee('Het bestand is niet geldig.');
        });
    }


}
