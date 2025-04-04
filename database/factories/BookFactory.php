<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    protected $model = Book::class;
    public function definition(): array
    {
        $quantityTotal = $this->faker->numberBetween(1, 10);
        return [
            'title' => $this->faker->sentence(3), // VD: "Lập trình PHP cơ bản"
            'author' => $this->faker->name(),
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
            'publisher' => $this->faker->company(), // VD: "NXB Kim Đồng"
            'description' => $this->faker->paragraph(),
            'isbn' => $this->faker->optional()->isbn13(), // Có thể null
            'quantity_total' => $quantityTotal,
            'quantity_available' => $this->faker->numberBetween(0, $quantityTotal),
        ];
    }
}
