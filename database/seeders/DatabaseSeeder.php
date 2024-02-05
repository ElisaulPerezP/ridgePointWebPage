<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(CarouselSeeder::class);
        $this->call(QuoteSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PendingMatterSeeder::class);

    }
}
