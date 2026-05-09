<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@bakomatic.com'],
            [
                'name' => 'Admin',
                'email' => 'admin@bakomatic.com',
                'password' => 'password',
            ],
        );

        $this->call([
            CategorySeeder::class,
            KitchenDataSeeder::class,
            HomepageSectionSeeder::class,
            DealerSeeder::class,
            FaqSeeder::class,
            TestimonialSeeder::class,
        ]);
    }
}
