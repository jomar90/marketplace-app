<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_id' => User::inRandomOrder()->first()->id,
            'receiver_id' => User::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
            'message' => fake()->sentence(),
        ];
    }
}
