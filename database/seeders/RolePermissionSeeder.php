<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $this->createDefaultPermissions();

        // create roles
        $superAdmin = Role::firstOrCreate([
            'name' => 'super admin',
            'guard_name' => 'admin'
        ]);

        $reviewer = Role::firstOrCreate([
            'name' => 'reviewer',
            'guard_name' => 'admin'
        ]);

        // give reviewer specific permission
        $reviewer->givePermissionTo('review products');

        // 🔥 give super admin ALL permissions
        $superAdmin->syncPermissions(Permission::where('guard_name', 'admin')->get());
    }

    function createDefaultPermissions(): void
    {
        $permissions = [
            ['review products', 'Review Products'],
            ['manage categories', 'Category Module'],
            ['manage order', 'Manage Order'],
            ['manage kyc', 'Manage KYC'],
            ['manage withdraw request', 'Manage Withdraw Request'],
            ['manage withdraw method', 'Manage Withdraw Method'],
            ['manage sections', 'Manage Sections'],
            ['manage socials', 'Manage Socials'],
            ['manage banner', 'Manage Banner'],
            ['page builder', 'Page Builder'],
            ['manage newsletter', 'Manage Newsletter'],
            ['access management', 'Access Management'],
            ['payment setting', 'Payment Setting'],
            ['manage settings', 'Manage Settings'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                [
                    'name' => $permission[0],
                    'guard_name' => 'admin'
                ],
                [
                    'group_name' => $permission[1]
                ]
            );
        }
    }
}
