<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->realText(rand(30, 40));
        $content = '<p>' . $this->faker->realText(rand(600, 800)) . '</p>' .
            '<p>' . $this->faker->realText(rand(600, 800)) . '</p>' .
            '<p>' . $this->faker->realText(rand(600, 800)) . '</p>';
        return [
            'title' => $name,
            'slug' =>  Str::slug($this->faker->realText(rand(20, 30))),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
            'img_prev' => 'https://images.unsplash.com/photo-1578262825743-a4e402caab76?ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80',
            'image' => 'https://c.dns-shop.ru/original/st4/cf211601c267afe36bacfa74ea97184c/a7ae4c87b121cbbd8e63e5856b571529e3f31419db7929092e64784578b4ca63.jpg',
            'body' => $content
        ];
    }
}
