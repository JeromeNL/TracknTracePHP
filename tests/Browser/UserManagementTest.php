<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserManagementTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testUsersPageDisplaysUsersManagement()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/users')
                ->assertSee('Gebruikersbeheer');
        });
    }

    public function testCreateAccountButton()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/users')
                ->waitFor('#create_account')
                ->click('#create_account')
                ->assertPathIs('/register');
        });
    }

    public function testCreateUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $browser->visit('/users');
            $browser->clickLink('Account aanmaken');
            $browser->visit('/register');
            $browser->type('name', 'JobHout');
            $browser->type('email', 'job@experience.com');
            $browser->type('password', 'a-mmCk7wg*dNdqR4kJfLYiaBNDpg.G9J.9ZH_axY');
            $browser->type('password_confirmation', 'a-mmCk7wg*dNdqR4kJfLYiaBNDpg.G9J.9ZH_axY');
            $browser->select('roles[]');
            $browser->select('webshop');
            $browser->press('Register');
            $browser->assertPathIs('/users');
            $browser->assertSee('succesvol aangemaakt');
        });
    }

    public function testEditNameOfUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $browser->visit('/users');
            $browser->press('Meer');
            $browser->clickLink('Bewerk');
            $browser->visit('/users/6/edit');
            $browser->type('name', 'DylanDeGraaff');
            $browser->press('Opslaan');
            $browser->assertPathIs('/users');
            $browser->assertSee('succesvol aangepast!');
        });
    }

    public function testEditRolesOfUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $browser->visit('/users');
            $browser->press('Meer');
            $browser->clickLink('Bewerk');
            $browser->visit('/users/6/edit');
            $browser->select('roles[]');
            $browser->press('Opslaan');
            $browser->assertPathIs('/users');
            $browser->assertSee('succesvol aangepast!');
        });
    }

    public function testEditWebshopOfUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1));
            $browser->visit('/users');
            $browser->press('Meer');
            $browser->clickLink('Bewerk');
            $browser->visit('/users/6/edit');
            $browser->select('webshop');
            $browser->press('Opslaan');
            $browser->assertPathIs('/users');
            $browser->assertSee('succesvol aangepast!');
        });
    }


}
