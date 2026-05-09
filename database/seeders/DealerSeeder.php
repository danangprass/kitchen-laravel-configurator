<?php

namespace Database\Seeders;

use App\Models\Dealer;
use Illuminate\Database\Seeder;

class DealerSeeder extends Seeder
{
    public function run(): void
    {
        $dealers = [
            // Unox Offices
            [
                'name' => 'Kitchen Indonesia Office - Jakarta',
                'type' => 'Unox Office',
                'service_level' => 'Platinum',
                'address' => 'Jl. Sudirman Raya No. 50, Jakarta Selatan',
                'latitude' => -6.2270,
                'longitude' => 106.8080,
                'phone' => '+62 800 000 0001',
                'email' => 'jakarta@example.com',
                'website' => null,
            ],
            [
                'name' => 'Kitchen Indonesia Office - Surabaya',
                'type' => 'Unox Office',
                'service_level' => 'Platinum',
                'address' => 'Jl. Pemuda No. 30, Surabaya',
                'latitude' => -7.2830,
                'longitude' => 112.7370,
                'phone' => '+62 800 000 0002',
                'email' => 'surabaya@example.com',
                'website' => null,
            ],
            // Gold dealers
            [
                'name' => 'PT Mitra Dapur Utama - Jakarta Selatan',
                'type' => 'Dealer',
                'service_level' => 'Gold',
                'address' => 'Jl. Cilandak Raya No. 18, Jakarta Selatan',
                'latitude' => -6.2940,
                'longitude' => 106.7960,
                'phone' => '+62 800 000 0010',
                'email' => 'mitradapur@example.com',
                'website' => null,
            ],
            [
                'name' => 'CV Sarana Kuliner Bandung',
                'type' => 'Dealer',
                'service_level' => 'Gold',
                'address' => 'Jl. Asia Afrika No. 100, Bandung',
                'latitude' => -6.9218,
                'longitude' => 107.6066,
                'phone' => '+62 800 000 0011',
                'email' => 'saranakuliner@example.com',
                'website' => null,
            ],
            [
                'name' => 'PT Peralatan Dapur Surabaya',
                'type' => 'Dealer',
                'service_level' => 'Gold',
                'address' => 'Jl. Pemuda No. 31, Surabaya',
                'latitude' => -7.2650,
                'longitude' => 112.7420,
                'phone' => '+62 800 000 0012',
                'email' => 'pdsurabaya@example.com',
                'website' => null,
            ],
            [
                'name' => 'UD Berkah Kitchen Equipment - Pontianak',
                'type' => 'Dealer',
                'service_level' => 'Gold',
                'address' => 'Jl. Gajah Mada No. 45, Pontianak',
                'latitude' => -0.0320,
                'longitude' => 109.3321,
                'phone' => '+62 800 000 0013',
                'email' => 'berkahkitchen@example.com',
                'website' => null,
            ],
            // Silver dealers
            [
                'name' => 'CV Anugerah Peralatan Hotel - Medan',
                'type' => 'Dealer',
                'service_level' => 'Silver',
                'address' => 'Jl. Diponegoro No. 88, Medan',
                'latitude' => 3.5850,
                'longitude' => 98.6870,
                'phone' => '+62 800 000 0020',
                'email' => 'anugerahhotel@example.com',
                'website' => null,
            ],
            [
                'name' => 'PT Solusi Dapur Semarang',
                'type' => 'Dealer',
                'service_level' => 'Silver',
                'address' => 'Jl. Pemuda No. 175, Semarang',
                'latitude' => -6.9980,
                'longitude' => 110.4100,
                'phone' => '+62 800 000 0021',
                'email' => 'solusidapur@example.com',
                'website' => null,
            ],
            [
                'name' => 'UD Maju Bersama - Yogyakarta',
                'type' => 'Dealer',
                'service_level' => 'Silver',
                'address' => 'Jl. Malioboro No. 52, Yogyakarta',
                'latitude' => -7.7931,
                'longitude' => 110.3651,
                'phone' => '+62 800 000 0022',
                'email' => 'majubersama@example.com',
                'website' => null,
            ],
            [
                'name' => 'CV Karya Mandiri - Makassar',
                'type' => 'Dealer',
                'service_level' => 'Silver',
                'address' => 'Jl. Penghibur No. 9, Makassar',
                'latitude' => -5.1323,
                'longitude' => 119.4100,
                'phone' => '+62 800 000 0023',
                'email' => 'karyamandiri@example.com',
                'website' => null,
            ],
            // Authorized dealers
            [
                'name' => 'Toko Peralatan Restoran - Denpasar',
                'type' => 'Dealer',
                'service_level' => 'Authorized',
                'address' => 'Jl. Teuku Umar No. 77, Denpasar',
                'latitude' => -8.6580,
                'longitude' => 115.2180,
                'phone' => '+62 800 000 0030',
                'email' => 'restoranequip@example.com',
                'website' => null,
            ],
            [
                'name' => 'CV Nusantara Kitchen Supply - Banjarmasin',
                'type' => 'Dealer',
                'service_level' => 'Authorized',
                'address' => 'Jl. Ahmad Yani No. 55, Banjarmasin',
                'latitude' => -3.3245,
                'longitude' => 114.5910,
                'phone' => '+62 800 000 0031',
                'email' => 'nusantarakitchen@example.com',
                'website' => null,
            ],
            [
                'name' => 'UD Sejahtera Dapur - Pekanbaru',
                'type' => 'Dealer',
                'service_level' => 'Authorized',
                'address' => 'Jl. Sudirman No. 38, Pekanbaru',
                'latitude' => 0.5142,
                'longitude' => 101.4431,
                'phone' => '+62 800 000 0032',
                'email' => 'sejahteradapur@example.com',
                'website' => null,
            ],
            [
                'name' => 'Toko Alat Masak Profesional - Batam',
                'type' => 'Dealer',
                'service_level' => 'Authorized',
                'address' => 'Jl. Imam Bonjol No. 12, Batam',
                'latitude' => 1.1285,
                'longitude' => 104.0531,
                'phone' => '+62 800 000 0033',
                'email' => 'alatmasak@example.com',
                'website' => null,
            ],
            [
                'name' => 'CV Mandiri Peralatan - Balikpapan',
                'type' => 'Dealer',
                'service_level' => 'Authorized',
                'address' => 'Jl. Sudirman No. 19, Balikpapan',
                'latitude' => -1.2450,
                'longitude' => 116.8510,
                'phone' => '+62 800 000 0034',
                'email' => 'mandiriperalatan@example.com',
                'website' => null,
            ],
        ];

        foreach ($dealers as $data) {
            Dealer::firstOrCreate(
                ['name' => $data['name']],
                array_merge($data, ['is_active' => true])
            );
        }
    }
}
