<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $user = \App\Models\User::query()->inRandomOrder()->first();

        $ship = $this->faker->randomElement(array_keys(\App\Models\Order::$shipStatusMap));

        return [
            'total_amount'   => 0,
            'remark'         => $this->faker->sentence,
            'payment_method' => $this->faker->randomElement(['cart', 'money']),
            'ship_status'    => $ship,
            'user_id'        => $user->id,
        ];
    }
}
