<?php

namespace Database\Seeders;

use App\Models\Bid;
use App\Models\Category;
use App\Models\Message;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Category::factory(5)->create();
        Product::factory(10)->create();
        Bid::factory(10)->create();
        Message::factory(10)->create();
    }
}
