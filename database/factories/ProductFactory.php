<?php

namespace Database\Factories;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = ['manual_car', 'automatic_car', 'truck', 'motorcycle', 'quad'];

        return [
            'name' => $this->faker->words(2, true),
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 50, 500),
            'category' => $this->faker->randomElement($categories),
            'image' => 'assets/product' . $this->faker->numberBetween(1, 5) . '.jpg',
            'duration' => $this->faker->numberBetween(30, 120),
            'level' => $this->faker->numberBetween(1, 5),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
