<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Fituser;
use Illuminate\Support\Facades\Hash;

class FituserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Fituser::create([
            'name' => 'admin',
            'password' => Hash::make('admin'),
            // 'password' => "admin",
        ])->exercises()->attach([
            1 => ['reps' => 10],
            2 => ['reps' => 20],
            3 => ['reps' => 15],
        ]);
        Fituser::create([
            'name' => 'michiel',
            'password' => Hash::make('password'),
            // 'password' => "password",
        ])->exercises()->attach([
            1 => ['reps' => 20],
            2 => ['reps' => 40],
            6 => ['reps' => 20],
            7 => ['reps' => 40],
        ]);
        Fituser::create([
            'name' => 'homestead',
            'password' => Hash::make('secret'),
            // 'password' => "secret",
        ])->exercises()->attach([
            3 => ['reps' => 15],
        ]);
    }
}
