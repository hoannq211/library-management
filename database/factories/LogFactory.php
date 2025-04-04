<?php

namespace Database\Factories;

use App\Models\Log;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Log>
 */
class LogFactory extends Factory
{
    protected $model = Log::class;
    public function definition(): array
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? 1, 
            'action' => $this->faker->randomElement(['Thêm sách', 'Xóa sách', 'Phê duyệt mượn']),
            'target_type' => $this->faker->randomElement(['book', 'borrow', 'user']),
            'target_id' => $this->faker->numberBetween(1, 100),
            'description' => $this->faker->sentence(),
            'created_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
