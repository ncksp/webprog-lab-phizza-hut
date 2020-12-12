<?php

use App\User;
use Carbon\Carbon;
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
        User::create([
            'name' => 'Nicko',
            'email' => 'n1@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make("mantap123"),
            'role' => 'admin',
            'phone' => '123123123123',
            'address' => 'bumi',
            'gender' => 'Male'
        ]);
        User::create([
            'name' => 'David',
            'email' => 'd1@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make("mantap123"),
            'role' => 'user',
            'address' => 'bumi',
            'phone' => '123123123123',
            'gender' => 'Male'
        ]);
    }
}
