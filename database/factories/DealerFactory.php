<?php

namespace Database\Factories;

use App\Models\Dealer;
use Illuminate\Database\Eloquent\Factories\Factory;

class DealerFactory extends Factory
{
    protected $model = Dealer::class;

    /**
     * Indonesian cities with approximate coordinates.
     */
    private const INDONESIAN_CITIES = [
        'Jakarta' => ['lat' => -6.2088, 'lng' => 106.8456],
        'Surabaya' => ['lat' => -7.2575, 'lng' => 112.7521],
        'Bandung' => ['lat' => -6.9175, 'lng' => 107.6191],
        'Medan' => ['lat' => 3.5952, 'lng' => 98.6722],
        'Semarang' => ['lat' => -6.9932, 'lng' => 110.4203],
        'Yogyakarta' => ['lat' => -7.7956, 'lng' => 110.3695],
        'Denpasar' => ['lat' => -8.6705, 'lng' => 115.2126],
        'Makassar' => ['lat' => -5.1477, 'lng' => 119.4327],
        'Palembang' => ['lat' => -2.9761, 'lng' => 104.7754],
        'Balikpapan' => ['lat' => -1.2379, 'lng' => 116.8529],
        'Manado' => ['lat' => 1.4748, 'lng' => 124.8421],
        'Batam' => ['lat' => 1.1301, 'lng' => 104.0527],
        'Pekanbaru' => ['lat' => 0.5071, 'lng' => 101.4478],
        'Banjarmasin' => ['lat' => -3.3186, 'lng' => 114.5944],
        'Jayapura' => ['lat' => -2.5916, 'lng' => 140.6690],
    ];

    public function definition(): array
    {
        $city = fake()->randomElement(array_keys(self::INDONESIAN_CITIES));
        $coords = self::INDONESIAN_CITIES[$city];
        $type = fake()->randomElement(Dealer::types());

        return [
            'name' => $type === 'Bakomatic Office'
                ? 'BAKOMATIC Indonesia Office - '.$city
                : fake()->company().' - '.$city,
            'type' => $type,
            'service_level' => fake()->randomElement(Dealer::serviceLevels()),
            'address' => fake()->streetAddress().', '.$city.', Indonesia',
            'latitude' => $coords['lat'] + fake()->randomFloat(7, -0.05, 0.05),
            'longitude' => $coords['lng'] + fake()->randomFloat(7, -0.05, 0.05),
            'phone' => fake()->phoneNumber(),
            'email' => fake()->companyEmail(),
            'website' => fake()->url(),
            'is_active' => true,
        ];
    }
}
