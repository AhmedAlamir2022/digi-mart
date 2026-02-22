<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        User::create([
            'name' => 'John Doe',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
        ]);

        User::create([
            'name' => 'Author',
            'email' => 'author@gmail.com',
            'user_type' => 'author',
            'kyc_status' => 1,
            'password' => bcrypt('password'),
        ]);
    }
}
