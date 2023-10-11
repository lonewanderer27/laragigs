<?php

namespace Database\Seeders;

use App\Models\Listing;
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
        // create a single user
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com'
        ]);

        // associate listings with that  user
        Listing::factory(10)->create([
            'user_id' => $user->id 
        ]);
    }
}