<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Block;

class BlocksTableSeeder extends Seeder
{
    public function run()
    {
        Block::factory()->count(10)->create();
    }
}
