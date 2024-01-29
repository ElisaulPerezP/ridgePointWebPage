<?php

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class QuoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Quote = Quote::factory()->create();
        $Quote2 = Quote::factory()->create();
        $Quote3 = Quote::factory()->create();
        $Quote4 = Quote::factory()->create();
        $Quote5 = Quote::factory()->create();
        $this->attachImageToQuote($Quote, 'quoteSampleImage.jpg');
        $this->attachImageToQuote($Quote2, 'quoteSampleImage2.jpg');
        $this->attachImageToQuote($Quote3, 'quoteSampleImage.jpg');
        $this->attachImageToQuote($Quote4, 'quoteSampleImage2.jpg');
        $this->attachImageToQuote($Quote5, 'quoteSampleImage.jpg');
    }
    private function attachImageToQuote(Quote $Quote, $imageName)
    {
        $imagePath = 'images/' . $imageName;
        $imageUrl = Storage::url($imagePath);
        $Quote->addMedia(public_path($imageUrl))->preservingOriginal()->toMediaCollection('quote_images');
    }
}
