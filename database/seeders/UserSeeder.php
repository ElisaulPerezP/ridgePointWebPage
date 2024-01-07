<?php

namespace Database\Seeders;

use App\Models\Carousel;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@ridgepoint.us',
        ]);
        $this->attachImageToUser($admin, 'muestra.jpg');
        $roleWebAdmin = Role::findOrCreate('admin', 'web');

        $admin->assignRole([$roleWebAdmin]);

    }
    private function attachImageToUser(User $user, $imageName)
    {
        $imagePath = 'avatar/' . $imageName;
        $imageUrl = Storage::url($imagePath);
        $user->addMedia(public_path($imageUrl))->preservingOriginal()->toMediaCollection('avatar_images');
    }
}
