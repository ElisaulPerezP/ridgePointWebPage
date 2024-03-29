<?php

namespace Database\Factories;

use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuoteFactory extends Factory
{
    protected $model = Quote::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail, 
            'description' => $this->faker->paragraph,
            'message' => $this->faker->sentence,
            'creation_date' => $this->faker->date,
            'creation_place' => $this->faker->city,
            'image_rights' => 'All rights reserved',
            'response_date' => $this->faker->date, 
            'response_message' => $this->faker->paragraph,
        ];
    }
}