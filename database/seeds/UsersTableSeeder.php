<?php

use App\Models\Blog\ProfileModel;
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
        $user = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make(12345678),
        ]);

        ProfileModel::create([
            'user_id' => $user->id,
            'avatar' => 'default.png',
        ]);
    }
}
