<?php

namespace Database\Seeders;

use App\Models\UploadFile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UploadFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UploadFile::factory()->count(30)->create();
    }
}
