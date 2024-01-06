<?php

namespace Database\Seeders;

use App\Models\Carousel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carousel = Carousel::factory()->create();
        $carousel2 = Carousel::factory()->create();
        $carousel3 = Carousel::factory()->create();
        $carousel4 = Carousel::factory()->create();
        $carousel5 = Carousel::factory()->create();
        $this->attachImageToCarousel($carousel, 'muestra.jpg');
        $this->attachImageToCarousel($carousel2, 'muestra2.jpg');
        $this->attachImageToCarousel($carousel3, 'muestra3.jpg');
        $this->attachImageToCarousel($carousel4, 'muestra4.jpg');
        $this->attachImageToCarousel($carousel5, 'muestra5.jpg');
    }
    private function attachImageToCarousel(Carousel $carousel, $imageName)
    {
        $imagePath = 'images/' . $imageName;
        $imageUrl = Storage::url($imagePath);
        $carousel->addMedia(public_path($imageUrl))->preservingOriginal()->toMediaCollection('carousel_images');
    }
}
