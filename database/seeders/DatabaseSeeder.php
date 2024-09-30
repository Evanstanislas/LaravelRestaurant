<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Food;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Food::factory(12)->create();

        User::factory()->create([
            'username' => 'Firstname Lastname',
            'email' => 'firstlast@gmail.com',
            'password' => Hash::make('thisisastrongpassword'),
            'role' => 'Admin',
        ]);

        User::factory()->create([
            'username' => 'Example',
            'email' => 'test@gmail.com',
            'password' => Hash::make('example'),
            'role' => 'User',
        ]);
    }
}
