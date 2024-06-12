<?php

namespace Database\Factories;

use App\Models\Appartement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppartementFactory extends Factory
{
    protected $model = Appartement::class;

    public function definition()
    {
        return [
            'floor' => $this->faker->word,
            'number' => $this->faker->randomNumber(3),
            // You can add more attributes as needed
        ];
    }
}
