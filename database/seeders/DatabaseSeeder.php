<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Movie;
use App\Models\User;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'user1',
            'email' => 'user1@example.com',
            'password' => 'password',
            'phone' => '000000000'
        ]);
        User::create([
            'name' => 'user2',
            'email' => 'user2@example.com',
            'password' => 'password',
            'phone' => '000000001'
        ]);
        User::create([
            'name' => 'user3',
            'email' => 'user3@example.com',
            'password' => 'password',
            'phone' => '000000002'
        ]);
        User::create([
            'name' => 'user4',
            'email' => 'user4@example.com',
            'password' => 'password',
            'phone' => '000000003'
        ]);
        Category::create(['name' => 'Comedy']);
        Category::create(['name' => 'Action']);
        Category::create(['name' => 'Drama']);
        Category::create(['name' => 'Fantasy']);
        Category::create(['name' => 'Horror']);
        Category::create(['name' => 'Romance']);
        Category::create(['name' => 'Thriller']);
        Category::create(['name' => 'Mystery']);
        Movie::factory(100)->create();
    }
}
