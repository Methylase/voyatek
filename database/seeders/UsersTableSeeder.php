<?php

namespace Database\Seeders;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // User::factory()->count(1)->create();
       User::create([
        'email' => 'bayo@yahoo.com',
        'email_verified_at' => now(),
        'password' => bcrypt('smoothless'),
        'api_token' => 'vg@123',
       ]);
    }
}
