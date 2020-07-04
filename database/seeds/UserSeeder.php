<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $users = array(
            [
                'name'  => 'Admin',
                'role'  => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('123456')
            ],
            [
                'name'  => 'Kasir',
                'role'  => 'kasir',
                'email' => 'kasir@gmail.com',
                'password' => Hash::make('123456')
            ],
            [
                'name'  => 'Waiter',
                'role'  => 'waiter',
                'email' => 'waiter@gmail.com',
                'password' => Hash::make('123456')
            ]
        );

        DB::table('users')->insert($users);
    }
}
