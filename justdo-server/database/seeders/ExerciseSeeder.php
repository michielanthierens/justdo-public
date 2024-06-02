<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Exercise;
use App\Models\Fituser;

class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Exercise::create([
            'difficulty' => 1,
        ])->translations()->createMany([
            [
                'language_code' => 'en',
                'exercise' => 'push ups',
                'description' => 'push ups are a great exercise for your chest and arms'
            ],[
                'language_code' => 'nl',
                'exercise' => 'opdrukken',
                'description' => 'opdrukken is een goede oefening voor je borst en armen'
            ]
        ]);
        Exercise::create([
            'difficulty' => 1,
        ])->translations()->createMany([
            [
            'language_code' => 'en',
            'exercise' => 'sit ups',
            'description' => 'sit ups are a great exercise for your abs'
            ],[
            'language_code' => 'nl',
            'exercise' => 'sit ups',
            'description' => 'sit ups zijn een goede oefening voor je buikspieren'
            ]
        ]);
        Exercise::create([
            'difficulty' => 3,
        ])->translations()->createMany([
            [
            'language_code' => 'en',
            'exercise' => 'Bench Press',
            'description' => 'Bench Press is a great exercise for your chest and arms'
            ],[
            'language_code' => 'nl',
            'exercise' => 'Bankdrukken',
            'description' => 'Bankdrukken is een goede oefening voor je borst en armen'
            ]
        ]);
        Exercise::create([
            'difficulty' => 4,
        ])->translations()->createMany([
            [
            'language_code' => 'en',
            'exercise' => 'Squat',
            'description' => 'Squat is a great exercise for your legs and glutes'
            ],[
            'language_code' => 'nl',
            'exercise' => 'Squat',
            'description' => 'Squat is een goede oefening voor je benen en billen'
            ]
        ]);
        Exercise::create([
            'difficulty' => 5,
        ])->translations()->createMany([
            [
            'language_code' => 'en',
            'exercise' => 'Deadlift',
            'description' => 'Deadlift is a great exercise for your back and legs'
            ],[
            'language_code' => 'nl',
            'exercise' => 'Deadlift',
            'description' => 'Deadlift is een goede oefening voor je rug en benen'
            ]
        ]);
        Exercise::create([
            'difficulty' => 3,
        ])->translations()->createMany([
            [
            'language_code' => 'en',
            'exercise' => 'Overhead Press',
            'description' => 'Overhead Press is a great exercise for your shoulders and arms'
            ],[
            'language_code' => 'nl',
            'exercise' => 'Overhead Press',
            'description' => 'Overhead Press is een goede oefening voor je schouders en armen'
            ]
        ]);
        Exercise::create([
            'difficulty' => 1,
        ])->translations()->createMany([
            [
            'language_code' => 'en',
            'exercise' => 'jumping jacks',
            'description' => 'jumping jacks are a great exercise for your whole body'
            ],[
            'language_code' => 'nl',
            'exercise' => 'jumping jacks',
            'description' => 'jumping jacks zijn een goede oefening voor je hele lichaam'
            ]
        ]);
        Exercise::create([
            'difficulty' => 1,
        ])->translations()->createMany([
            [
            'language_code' => 'en',
            'exercise' => 'go for a run',
            'description' => 'running is a great exercise for your legs and heart'
            ],[
            'language_code' => 'nl',
            'exercise' => 'ga een stukje hardlopen',
            'description' => 'hardlopen is een goede oefening voor je benen en hart'
            ]
        ]);
        Exercise::create([
            'difficulty' => 2,
        ])->translations()->createMany([
            [
            'language_code' => 'en',
            'exercise' => 'go for a swim',
            'description' => 'swimming is a great exercise for your whole body'
            ],[
            'language_code' => 'nl',
            'exercise' => 'ga een stukje zwemmen',
            'description' => 'zwemmen is een goede oefening voor je hele lichaam'
            ]
        ]);
        Exercise::create([
            'difficulty' => 1,
        ])->translations()->createMany([
            [
            'language_code' => 'en',
            'exercise' => 'go for a walk',
            'description' => 'walking is a great exercise for your legs and heart'
            ],[
            'language_code' => 'nl',
            'exercise' => 'ga een stukje wandelen',
            'description' => 'wandelen is een goede oefening voor je benen en hart'
            ]
            ]);
    }
}
