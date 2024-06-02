<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Fituser;
use App\Models\Exercise;
use Illuminate\Database\Seeder;
use Database\Seeders\FituserSeeder;
use Database\Seeders\ExerciseSeeder;
use Database\Seeders\SetSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(
            [
                ExerciseSeeder::class,
                FituserSeeder::class,
            ]
            );
    }
}
