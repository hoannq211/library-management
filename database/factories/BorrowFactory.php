<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrow>
 */
class BorrowFactory extends Factory
{
    protected $model = Borrow::class;
    public function definition(): array
    {
        $borrowDate = $this->faker->dateTimeThisYear();
        $dueDate = (clone $borrowDate)->modify('+7 days');
        return [
            'user_id' => User::inRandomOrder()->first()->id ?? 1,
            'book_id' => Book::inRandomOrder()->first()->id ?? 1,
            'borrow_date' => $borrowDate,
            'due_date' => $dueDate,
            'return_date' => $this->faker->optional(0.5)->dateTimeBetween($borrowDate, 'now'), // 50% có return_date
            'status' => $this->faker->randomElement(['pending', 'approved', 'returned', 'overdue']),
            'renewal_count' => $this->faker->numberBetween(0, 2),
        ];
    }
}
