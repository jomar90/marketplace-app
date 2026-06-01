<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'category_id' => Category::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'stock' => $this->faker->numberBetween(0, 100),
            'slug' => Str::slug($this->faker->unique()->name()),
        ];
    }
}
