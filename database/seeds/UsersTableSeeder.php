<?php

use Illuminate\Database\Seeder;
use App\Models\Blog\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(12345678),
            'admin' => 1
        ]);
    }
}
