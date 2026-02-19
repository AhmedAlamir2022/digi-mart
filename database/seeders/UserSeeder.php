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

        $user = new User();
        $user->name = 'User';
        $user->email = 'user@gmail.com';
        $user->password = bcrypt('user');
        $user->save();

        // Author
        $author = new User();
        $author->name = 'Author';
        $author->email = 'author@gmail.com';
        $author->password = bcrypt('reviewer');
        $author->role = 'author';
        $author->kyc_status = '1';
        $author->save();
    }
}
