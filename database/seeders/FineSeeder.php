<?php

namespace Database\Seeders;

use App\Models\Fine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fine::factory()->count(6)->create();
        
    }
}
