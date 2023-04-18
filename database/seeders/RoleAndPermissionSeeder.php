<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $manageUsers = Permission::create(['name' => 'manage-users']);
        $manageWebshops = Permission::create(['name' => 'manage-webshops']);

        $manageDelivery = Permission::create(['name' => 'manage-delivery']);
        $showDelivery = Permission::create(['name' => 'show-delivery']);
        $updateStatus = Permission::create(['name' => 'update-status-delivery']);

        $reviewDelivery = Permission::create(['name' => 'review-delivery']);

        $adminRole = Role::create(['name' => 'SuperAdmin']);
        $administrativeAssistant = Role::create(['name' => 'AdministrativeAssistant']);
        $packageHandler = Role::create(['name' => 'PackageHandler']);

        $customer = Role::create(['name' => 'Customer']);
        $deliveryCompany = Role::create(['name' => 'DeliveryCompany']);

        $adminRole->givePermissionTo([
            $manageUsers,
            $manageWebshops,
            $manageDelivery,
            $showDelivery,
        ]);

        $administrativeAssistant ->givePermissionTo([
            $manageDelivery,
            $showDelivery,
        ]);

        $packageHandler->givePermissionTo([
            $showDelivery,
        ]);

        $customer->givePermissionTo([
            $reviewDelivery,
            $showDelivery,
        ]);

        $deliveryCompany->givePermissionTo([
            $updateStatus,
        ]);

    }
}
