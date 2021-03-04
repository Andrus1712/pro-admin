<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);

        $user_andres = \App\Models\User::create([
            'DNI' => 1073830111,
            'username' => 1073830111,
            'first_name' => "Andres",
            'last_name' => "Calderon",
            'email' => "acaldup@gmail.com",
            'phone_number' => "3177765722",
            'location' => "monteria",
            'email_verified_at' => now(),
            'password' => Hash::make("andres123"),
            'last_time' => now(),
        ]);

        $user_andres->assignRole('Admin');
        $user_andres->assignRole('User');

        \App\Models\User::factory(10)->create();
    }
}
