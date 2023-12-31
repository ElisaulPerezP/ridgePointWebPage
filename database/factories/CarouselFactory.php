<?php

namespace Database\Factories;

use App\Models\Carousel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class CarouselFactory extends Factory
{
    protected $model = Carousel::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'message' => $this->faker->sentence,
            'creation_date' => $this->faker->date,
            'creation_place' => $this->faker->city,
            'image_rights' => 'All rights reserved',
        ];
    }
}