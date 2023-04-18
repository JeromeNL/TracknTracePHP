<?php

namespace Database\Seeders;

use App\Models\Webshop;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WebshopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Webshop::factory()->count(20)->create();
    }
}
