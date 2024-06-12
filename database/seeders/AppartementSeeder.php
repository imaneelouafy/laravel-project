<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appartement;

class AppartementSeeder extends Seeder
{
    public function run()
    {
        // Seed appartements data
        Appartement::create([
            'block_id'=>'1',
            'floor' => '1A',
            'number' => 101,
        ]);

        Appartement::create([
            'block_id'=>'2',
            'floor' => '2B',
            'number' => 102,
        ]);
        Appartement::create([
            'block_id'=>'3',
            'floor' => '3B',
            'number' => 43,
        ]);

        // Add more appartements as needed
    }
}
