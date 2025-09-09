<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\TeamLevel;
use Illuminate\Support\Facades\Log;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch the prefix from TeamLevel or default to 'DEF'
        // $teamLevel = TeamLevel::find(1);
        $prefix = 'DEF';

        $users = [
            [
                'name'       => 'admin',
                'email'      => 'admin@gmail.com',
                'password'   => bcrypt('admin'),
                'role'       => '0',
            ],
            [
                'name'       => 'user',
                'email'      => 'user@gmail.com',
                'password'   => bcrypt('user'),
                'role'       => '1',
            ],
        ];

        foreach ($users as $user) {
            // $user['unique_id'] = $prefix . strtoupper(Str::random(8)); // Ensure unique_id exists
            $user['email_verified_at'] = now(); // Optional: pre-verify email
            $user['remember_token'] = Str::random(10); // Laravel expects this

            Log::info("Seeding user:", $user); // For debugging/logging
            DB::table('users')->insert($user);
        }
    }
}
