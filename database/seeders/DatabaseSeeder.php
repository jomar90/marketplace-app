<?php

namespace Database\Seeders;

use App\Models\Bid;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('asdfasdf'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Seller User',
            'email' => 'seller@example.com',
            'password' => bcrypt('asdfasdff'),
            'role' => 'seller',
        ]);

        User::factory()->create([
            'name' => 'Buyer User',
            'email' => 'buyer@example.com',
            'password' => bcrypt('asdfasdfff'),
            'role' => 'buyer',
        ]);

        // Bid::create([
        //     'user_id' => 3, // buyer
        //     'product_id' => 1,
        //     'amount' => 150,
        // ]);

        // Message::create([
        //     'sender_id' => 3,
        //     'receiver_id' => 2,
        //     'product_id' => 1,
        //     'message' => 'Is this product still available?',
        // ]);

        $this->call(ProductSeeder::class);
    }
}
