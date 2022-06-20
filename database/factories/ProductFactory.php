<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(rand(15, 40)),
            'price' => rand(500, 12000),
            'description' => $this->faker->realText(rand(100, 200)),
            'category_id' => $this->faker->randomElement(Category::pluck('id')),
            'image' => 'https://images.unsplash.com/photo-1578262825743-a4e402caab76?ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80',
            'sold_count'   => 0,
            'review_count' => 0,
        ];
    }
}
