<?php
namespace Database\Seeders;

use App\Models\User;
use App\Models\PendingMatter;
use Illuminate\Database\Seeder;

class PendingMatterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PendingMatter::factory(10)->create([
            'client_id' => User::factory(),
            'responsible_id' => User::factory(),
        ]);
    }
}