<?php

namespace Database\Factories;

use App\Models\UploadFile;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UploadFile>
 */
class UploadFileFactory extends Factory
{
    protected $model = UploadFile::class;
    public function definition(): array
    {
        return [
            'file_path' => 'https://picsum.photos/640/480?random=' . rand(1,1000),
            'file_type' => 'image',
            'target_type' => $this->faker->randomElement(['user', 'book']),
            'target_id' => $this->faker->numberBetween(1, 18),
            'uploaded_by' => User::inRandomOrder()->first()->id ?? 1,
        ];
    }
}
