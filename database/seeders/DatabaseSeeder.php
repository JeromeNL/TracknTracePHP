<?php

namespace Database\Seeders;

use App\Models\User;
use Arr;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleAndPermissionSeeder::class,
            WebshopSeeder::class,
            CustomerSeeder::class,
            PackageSeeder::class,
            DeliverySeeder::class,

        ]);

        $superAdmin = User::factory()->create([
            'name' => 'SuperAdmin',
            'email' => 'superadmin@trackr.com',
            'password' => bcrypt('!Ndn.rXjRnC4Ks7T*x3@cEoxwRYrneTXyng7Xx6M'),
        ]);

        $superAdmin->assignRole('SuperAdmin');

        User::factory(50)->create();

        $this->call([
            ReviewSeeder::class,
        ]);

        $roles = ['AdministrativeAssistant', 'PackageHandler', 'Customer', 'DeliveryCompany'];

        foreach (User::all() as $user) {
            $user->assignRole(Arr::random($roles));
        }
    }
}
