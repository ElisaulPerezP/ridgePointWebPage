<?php

namespace Database\Factories;

use App\Models\PendingMatter;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class PendingMatterFactory extends Factory
{
    protected $model = PendingMatter::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'message' => $this->faker->sentence,
            'creation_date' => $this->faker->date,
            'creation_place' => $this->faker->city,
            'client_id' => User::factory(),
            'responsible_id' => User::factory(),
        ];
    }
}