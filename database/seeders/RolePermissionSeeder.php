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
            ['show all pending items', 'Pending Items'],
            ['show pending item info', 'Pending Items'],
            ['download pending item', 'Pending Items'],
            ['show all resubmitted items', 'Resubmitted Items'],
            ['show resubmitted item info', 'Resubmitted Items'],
            ['download resubmitted item', 'Resubmitted Items'],
            ['show all soft-rejected items', 'Soft Rejected Items'],
            ['show soft-rejected item info', 'Soft Rejected Items'],
            ['download soft-rejected item', 'Soft Rejected Items'],
            ['show all hard-rejected items', 'Hard Rejected Items'],
            ['show hard-rejected item info', 'Hard Rejected Items'],
            ['download hard-rejected item', 'Hard Rejected Items'],
            ['show all approved items', 'Approved Items'],
            ['show approved item info', 'Approved Items'],
            ['download approved item', 'Approved Items'],
            ['show all categories', 'Category Module'],
            ['add new category', 'Category Module'],
            ['edit category', 'Category Module'],
            ['delete category', 'Category Module'],
            ['show all sub-categories', 'Sub-Category Module'],
            ['add new sub-category', 'Sub-Category Module'],
            ['edit sub-category', 'Sub-Category Module'],
            ['delete sub-category', 'Sub-Category Module'],
            ['show all orders', 'Manage Order'],
            ['show order details', 'Manage Order'],
            ['kyc settings', 'Manage KYC Settings'],
            ['show kyc requests', 'Manage KYC Requests'],
            ['update kyc request', 'Manage KYC Requests'],
            ['download kyc file', 'Manage KYC Requests'],
            ['show withdraw methods', 'Manage Withdraw Method'],
            ['add new withdraw method', 'Manage Withdraw Method'],
            ['edit withdraw method', 'Manage Withdraw Method'],
            ['delete withdraw method', 'Manage Withdraw Method'],
            ['show all withdraw requests', 'Manage Withdraw Request'],
            ['show withdraw request info', 'Manage Withdraw Request'],
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
        $reviewer->givePermissionTo('show all approved items');

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
