<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $this->attachImageToUser($user, 'muestra.jpg');
            $role = Role::where('name', 'user')->first();
            $user->assignRole($role);
        });


    }

    private function attachImageToUser(User $user, $imageName)
    {
        $imagePath = 'avatar/' . $imageName;
        $imageUrl = Storage::url($imagePath);
        $user->addMedia(public_path($imageUrl))->preservingOriginal()->toMediaCollection('avatar_images');
    }
}
