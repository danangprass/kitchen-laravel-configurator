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
                'name' => 'UNOX Indonesia Office - Jakarta',
                'type' => 'Unox Office',
                'service_level' => 'Platinum',
                'address' => 'Jl. Jend. Sudirman Kav. 52-53, Senayan, Jakarta Selatan 12190',
                'latitude' => -6.2270,
                'longitude' => 106.8080,
                'phone' => '+62 21 5150088',
                'email' => 'jakarta@kitchen.com',
                'website' => 'https://www.kitchen.com',
            ],
            [
                'name' => 'UNOX Indonesia Office - Surabaya',
                'type' => 'Unox Office',
                'service_level' => 'Platinum',
                'address' => 'Jl. Raya Darmo No. 54, Wonokromo, Surabaya 60241',
                'latitude' => -7.2830,
                'longitude' => 112.7370,
                'phone' => '+62 31 5673210',
                'email' => 'surabaya@kitchen.com',
                'website' => 'https://www.kitchen.com',
            ],
            // Gold dealers
            [
                'name' => 'PT Mitra Dapur Profesional',
                'type' => 'Dealer',
                'service_level' => 'Gold',
                'address' => 'Jl. Fatmawati Raya No. 18, Cilandak, Jakarta Selatan 12430',
                'latitude' => -6.2940,
                'longitude' => 106.7960,
                'phone' => '+62 21 7651234',
                'email' => 'info@mitradapur.co.id',
                'website' => 'https://www.mitradapur.co.id',
            ],
            [
                'name' => 'CV Sarana Kuliner Bandung',
                'type' => 'Dealer',
                'service_level' => 'Gold',
                'address' => 'Jl. Asia Afrika No. 112, Sumur Bandung, Bandung 40261',
                'latitude' => -6.9218,
                'longitude' => 107.6066,
                'phone' => '+62 22 4231567',
                'email' => 'sales@saranakuliner.com',
                'website' => 'https://www.saranakuliner.com',
            ],
            [
                'name' => 'PT Peralatan Dapur Surabaya',
                'type' => 'Dealer',
                'service_level' => 'Gold',
                'address' => 'Jl. Pemuda No. 31-33, Genteng, Surabaya 60271',
                'latitude' => -7.2650,
                'longitude' => 112.7420,
                'phone' => '+62 31 5342890',
                'email' => 'info@pdsurabaya.co.id',
                'website' => null,
            ],
            [
                'name' => 'UD Berkah Kitchen Equipment',
                'type' => 'Dealer',
                'service_level' => 'Gold',
                'address' => 'Jl. Gajah Mada No. 45, Pontianak Kota, Pontianak 78111',
                'latitude' => -0.0320,
                'longitude' => 109.3321,
                'phone' => '+62 561 7351234',
                'email' => 'berkahkitchen@gmail.com',
                'website' => null,
            ],
            // Silver dealers
            [
                'name' => 'CV Anugerah Peralatan Hotel',
                'type' => 'Dealer',
                'service_level' => 'Silver',
                'address' => 'Jl. Diponegoro No. 88, Menteng, Medan 20152',
                'latitude' => 3.5850,
                'longitude' => 98.6870,
                'phone' => '+62 61 4152345',
                'email' => 'anugerah.hotel@gmail.com',
                'website' => null,
            ],
            [
                'name' => 'PT Solusi Dapur Semarang',
                'type' => 'Dealer',
                'service_level' => 'Silver',
                'address' => 'Jl. Pemuda No. 175, Semarang Tengah, Semarang 50132',
                'latitude' => -6.9980,
                'longitude' => 110.4100,
                'phone' => '+62 24 3540678',
                'email' => 'solusidapur.smg@gmail.com',
                'website' => null,
            ],
            [
                'name' => 'UD Maju Bersama Yogyakarta',
                'type' => 'Dealer',
                'service_level' => 'Silver',
                'address' => 'Jl. Malioboro No. 52, Gedongtengen, Yogyakarta 55271',
                'latitude' => -7.7931,
                'longitude' => 110.3651,
                'phone' => '+62 274 563821',
                'email' => 'majubersama.jogja@gmail.com',
                'website' => null,
            ],
            [
                'name' => 'CV Karya Mandiri Makassar',
                'type' => 'Dealer',
                'service_level' => 'Silver',
                'address' => 'Jl. Penghibur No. 9, Ujung Pandang, Makassar 90111',
                'latitude' => -5.1323,
                'longitude' => 119.4100,
                'phone' => '+62 411 3620456',
                'email' => 'karyamandiri.mks@gmail.com',
                'website' => null,
            ],
            // Authorized dealers
            [
                'name' => 'Toko Peralatan Restoran Bali',
                'type' => 'Dealer',
                'service_level' => 'Authorized',
                'address' => 'Jl. Teuku Umar No. 77, Dauh Puri Klod, Denpasar 80114',
                'latitude' => -8.6580,
                'longitude' => 115.2180,
                'phone' => '+62 361 241567',
                'email' => 'restoranequip.bali@gmail.com',
                'website' => null,
            ],
            [
                'name' => 'CV Nusantara Kitchen Supply',
                'type' => 'Dealer',
                'service_level' => 'Authorized',
                'address' => 'Jl. Ahmad Yani No. 55, Banjarmasin Tengah, Banjarmasin 70111',
                'latitude' => -3.3245,
                'longitude' => 114.5910,
                'phone' => '+62 511 4381234',
                'email' => 'nusantarakitchen.bjm@gmail.com',
                'website' => null,
            ],
            [
                'name' => 'UD Sejahtera Dapur Pekanbaru',
                'type' => 'Dealer',
                'service_level' => 'Authorized',
                'address' => 'Jl. Jend. Sudirman No. 38, Senapelan, Pekanbaru 28127',
                'latitude' => 0.5142,
                'longitude' => 101.4431,
                'phone' => '+62 761 853210',
                'email' => 'sejahteradapur.pkb@gmail.com',
                'website' => null,
            ],
            [
                'name' => 'Toko Alat Masak Profesional Batam',
                'type' => 'Dealer',
                'service_level' => 'Authorized',
                'address' => 'Jl. Imam Bonjol No. 12, Nagoya, Batam 29444',
                'latitude' => 1.1285,
                'longitude' => 104.0531,
                'phone' => '+62 778 451234',
                'email' => 'alatmasak.batam@gmail.com',
                'website' => null,
            ],
            [
                'name' => 'CV Mandiri Peralatan Balikpapan',
                'type' => 'Dealer',
                'service_level' => 'Authorized',
                'address' => 'Jl. Jend. Sudirman No. 19, Balikpapan Kota, Balikpapan 76113',
                'latitude' => -1.2450,
                'longitude' => 116.8510,
                'phone' => '+62 542 731456',
                'email' => 'mandiri.bpp@gmail.com',
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
