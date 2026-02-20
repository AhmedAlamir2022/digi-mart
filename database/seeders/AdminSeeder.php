<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::truncate();
        Role::where('guard_name', 'admin')->delete();

        // Create Roles
        $superAdminRole = Role::create([
            'name' => 'super admin',
            'guard_name' => 'admin'
        ]);

        $reviewerRole = Role::create([
            'name' => 'reviewer',
            'guard_name' => 'admin'
        ]);

        // Super Admin
        $admin = Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
        ]);

        $admin->assignRole($superAdminRole);

        // Reviewer
        $reviewer = Admin::create([
            'name' => 'Reviewer',
            'email' => 'reviewer@gmail.com',
            'password' => bcrypt('reviewer'),
        ]);

        $reviewer->assignRole($reviewerRole);
    }
}
