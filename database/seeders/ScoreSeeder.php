<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Score;

class ScoreSeeder extends Seeder
{
    public function run()
    {
        // Create 10 sample scores
        for ($i = 1; $i <= 10; $i++) {
            Score::create([
                'user_id' => $i, // Replace with actual user ID
                'score' => rand(100, 1000), // Generate a random score
            ]);
        }
    }
}
