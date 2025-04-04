<?php

namespace Database\Factories;

use App\Models\Borrow;
use App\Models\Fine;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fine>
 */
class FineFactory extends Factory
{
    protected $model = Fine::class;
    public function definition(): array
    {
        return [
            'borrow_id' => Borrow::inRandomOrder()->first()->id ?? 1,
            'user_id' => User::inRandomOrder()->first()->id ?? 1,
            'amount' => $this->faker->randomFloat(2, 1000, 50000), // VD: 5000.00
            'reason' => $this->faker->sentence(), // VD: "Trả sách muộn 3 ngày"
            'paid_status' => $this->faker->randomElement(['unpaid', 'paid']),
        ];
    }
}
