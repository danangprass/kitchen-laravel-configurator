<?php

namespace Database\Seeders;

use App\Models\Dealer;
use Illuminate\Database\Seeder;

class DealerSeeder extends Seeder
{
    public function run(): void
    {
        Dealer::factory()->count(20)->create();
    }
}
