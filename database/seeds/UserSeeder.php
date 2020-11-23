<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['id' => 1],
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'password' => Hash::make('11111111'),
                'user_type' => 0,
                'status' => 1,
            ]
        );

        /* User::updateOrCreate(
            ['id' => 2],
            [
                'name' => 'test',
                'email' => 'test@gmail.com',
                'username' => 'test',
                'password' => Hash::make('11111111'),
                'user_type' => 1,
                'status' => 1,
            ]
        ); */
    }
}
