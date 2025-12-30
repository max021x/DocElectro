<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'password' => Hash::make("admin123")
        ]);
        User::factory()->create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make("user123")
        ]);

        Post::factory()->count(40)->create() ; 
    }
}
