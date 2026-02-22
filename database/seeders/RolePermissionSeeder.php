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
        // clear all permissions befour seed
        Permission::where('guard_name', 'admin')->delete();
        // تنظيف الكاش
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1️⃣ إنشاء Permissions أولًا
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
            ['show roles', 'Roles Management'],
            ['create roles', 'Roles Management'],
            ['edit roles', 'Roles Management'],
            ['delete roles', 'Roles Management'],
            ['show user roles', 'User Roles Management'],
            ['create user roles', 'User Roles Management'],
            ['edit user roles', 'User Roles Management'],
            ['delete user roles', 'User Roles Management'],
            ['payment setting', 'Payment Setting'],
            ['manage settings', 'Manage Settings'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(
                ['name' => $permission[0], 'guard_name' => 'admin'],
                ['group_name' => $permission[1]]
            );
        }

        // 2️⃣ إنشاء Roles بعد Permissions
        $superAdmin = Role::firstOrCreate([
            'name' => 'super admin',
            'guard_name' => 'admin'
        ]);

        $reviewer = Role::firstOrCreate([
            'name' => 'reviewer',
            'guard_name' => 'admin'
        ]);

        // 3️⃣ إعطاء Permissions
        $reviewer->givePermissionTo('review products');

        $superAdmin->syncPermissions(Permission::where('guard_name', 'admin')->get());

        // 4️⃣ إنشاء حسابات Admins
        \App\Models\Admin::truncate();

        $admin = \App\Models\Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin')
        ]);
        $admin->assignRole('super admin'); // ✅ هنا الدور موجود

        $reviewerUser = \App\Models\Admin::create([
            'name' => 'Reviewer',
            'email' => 'reviewer@gmail.com',
            'password' => bcrypt('reviewer')
        ]);
        $reviewerUser->assignRole('reviewer');
    }
}
