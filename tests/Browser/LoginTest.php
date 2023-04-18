<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{

    /**
     * Test the login page.
     *
     * @return void
     */
    public function testLoginPage(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                ->assertSee('Inloggen')
                ->assertVisible('input[name="email"]')
                ->assertVisible('input[name="password"]');
        });
    }

    public function testLoginWithTestUser()
    {
        $user = User::factory()->create(
            ['password' => bcrypt('welkom10')]
        );

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->assertSee('Inloggen')
                ->type('email', $user->email)
                ->type('password', 'welkom10')
                ->press('Inloggen')
                ->assertPathIs('/home')
                ->assertSee('Welkom!');
        });

        $user->delete();
    }

    public function testLoginWithTestUser_fail()
    {
        $user = User::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->assertSee('Inloggen')
                ->type('email', $user->email)
                ->type('password', 'incorrect_pw')
                ->press('Inloggen')
                ->assertPathIs('/login');
        });

        $user->delete();
    }

    public function testLogout()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/')
                ->click('#navbarDropdown')
                ->click('#logout_button')
                ->assertPathIs('/')
                ->assertSee('Welkom op de website van TrackR, de beste track & trace applicatie van de wereld.');
        });
    }
}
