<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'customer_name' => 'Budi Santoso',
                'company' => 'Grand Hyatt Jakarta',
                'industry' => 'Hotel',
                'photo' => 'https://picsum.photos/seed/budi/200/200',
                'quote' => 'Oven Kitchen benar-benar mengubah cara kami bekerja di dapur. Hasil masakan lebih konsisten dan waktu memasak lebih cepat. Sangat direkomendasikan untuk operasi hotel berskala besar.',
                'rating' => 5,
                'is_featured' => true,
                'sort_order' => 10,
            ],
            [
                'customer_name' => 'Sari Dewi',
                'company' => 'Holland Bakery',
                'industry' => 'Bakery',
                'photo' => 'https://picsum.photos/seed/sari/200/200',
                'quote' => 'Sebagai pastry chef, konsistensi adalah segalanya. Kitchen memberikan hasil yang sama setiap kali. Kue dan roti kami selalu mengembang sempurna di semua outlet.',
                'rating' => 5,
                'is_featured' => true,
                'sort_order' => 20,
            ],
            [
                'customer_name' => 'Agus Wijaya',
                'company' => 'Marriott Yogyakarta',
                'industry' => 'Hospitality',
                'photo' => 'https://picsum.photos/seed/agus/200/200',
                'quote' => 'Investasi terbaik yang pernah kami lakukan untuk dapur hotel. Efisiensi energi dan kualitas masakan benar-benar di atas ekspektasi. Staf dapur kami sangat terbantu.',
                'rating' => 5,
                'is_featured' => true,
                'sort_order' => 30,
            ],
            [
                'customer_name' => 'Rina Hartono',
                'company' => 'Restoran Sederhana',
                'industry' => 'Restoran',
                'photo' => 'https://picsum.photos/seed/rina/200/200',
                'quote' => 'Kami telah menggunakan oven Kitchen selama 3 tahun dan tidak pernah kecewa. Perawatannya mudah dan hasilnya selalu sempurna. Tim support juga sangat responsif.',
                'rating' => 5,
                'is_featured' => false,
                'sort_order' => 40,
            ],
            [
                'customer_name' => 'Hendra Gunawan',
                'company' => 'Plataran Borobudur',
                'industry' => 'Fine Dining',
                'photo' => 'https://picsum.photos/seed/hendra/200/200',
                'quote' => 'Dari semua oven komersial yang pernah kami gunakan, Kitchen adalah yang paling andal. Fitur self-cleaning-nya menghemat banyak waktu staf dapur kami setiap harinya.',
                'rating' => 5,
                'is_featured' => false,
                'sort_order' => 50,
            ],
            [
                'customer_name' => 'Maya Putri',
                'company' => 'Rotiboy',
                'industry' => 'Pastry Shop',
                'photo' => 'https://picsum.photos/seed/maya/200/200',
                'quote' => 'Kami membuka cabang baru dan langsung menggunakan Kitchen di semua outlet. Standarisasi rasa antar cabang jadi lebih mudah dengan teknologi presisi mereka.',
                'rating' => 4,
                'is_featured' => false,
                'sort_order' => 60,
            ],
            [
                'customer_name' => 'Dian Permata',
                'company' => 'Hotel Santika Premiere',
                'industry' => 'Hotel',
                'photo' => 'https://picsum.photos/seed/dian/200/200',
                'quote' => 'Chef kami sangat puas dengan presisi suhu oven Kitchen. Tidak ada lagi keluhan tentang kematangan yang tidak merata. Game changer untuk dapur profesional kami!',
                'rating' => 5,
                'is_featured' => false,
                'sort_order' => 70,
            ],
            [
                'customer_name' => 'Rudi Hermawan',
                'company' => 'Bakmi GM',
                'industry' => 'Restoran',
                'photo' => 'https://picsum.photos/seed/rudi/200/200',
                'quote' => 'Pelanggan kami langsung merasakan perbedaan sejak kami beralih ke Kitchen. Tekstur dan rasa lebih baik, dan kami bisa melayani lebih banyak pesanan setiap harinya.',
                'rating' => 4,
                'is_featured' => false,
                'sort_order' => 80,
            ],
            [
                'customer_name' => 'Anisa Rahma',
                'company' => 'The Westin Resort Bali',
                'industry' => 'Hospitality',
                'photo' => 'https://picsum.photos/seed/anisa/200/200',
                'quote' => 'Dukungan teknis Kitchen di Indonesia sangat membantu. Mereka datang langsung untuk training staf kami. Layanan purna jual yang luar biasa dan sangat profesional.',
                'rating' => 5,
                'is_featured' => false,
                'sort_order' => 90,
            ],
            [
                'customer_name' => 'Bayu Prasetyo',
                'company' => 'Catering Nusantara Premium',
                'industry' => 'Catering',
                'photo' => 'https://picsum.photos/seed/bayu/200/200',
                'quote' => 'Sebagai konsultan dapur komersial, saya selalu merekomendasikan Kitchen ke klien. Rasio harga dan performa tidak ada yang menandingi di kelasnya untuk kebutuhan catering skala besar.',
                'rating' => 5,
                'is_featured' => false,
                'sort_order' => 100,
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::firstOrCreate(
                ['customer_name' => $data['customer_name'], 'company' => $data['company']],
                array_merge($data, ['video_url' => null, 'is_active' => true])
            );
        }
    }
}
