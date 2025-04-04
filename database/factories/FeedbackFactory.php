<?php

namespace Database\Factories;

use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Feedback>
 */
class FeedbackFactory extends Factory
{
    protected $model = Feedback::class;
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? 1,
            'content' => $this->faker->paragraph(),
            'type' => $this->faker->randomElement(['suggestion', 'error']),
            'status' => $this->faker->randomElement(['pending', 'resolved']),
        ];
    }
}
