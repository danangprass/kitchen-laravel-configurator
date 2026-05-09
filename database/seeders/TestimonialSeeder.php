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
                'customer_name' => 'A. Wirawan',
                'company' => 'Sunrise Boutique Hotel Jakarta',
                'industry' => 'Hotel',
                'photo' => 'https://picsum.photos/seed/demo01/200/200',
                'quote' => 'Oven Kitchen benar-benar mengubah cara kami bekerja di dapur. Hasil masakan lebih konsisten dan waktu memasak lebih cepat. Sangat direkomendasikan untuk operasi hotel berskala besar.',
                'rating' => 5,
                'is_featured' => true,
                'sort_order' => 10,
            ],
            [
                'customer_name' => 'S. Kusuma',
                'company' => 'Roti Emas Bakery Surabaya',
                'industry' => 'Bakery',
                'photo' => 'https://picsum.photos/seed/demo02/200/200',
                'quote' => 'Sebagai pastry chef, konsistensi adalah segalanya. Kitchen memberikan hasil yang sama setiap kali. Kue dan roti kami selalu mengembang sempurna di semua outlet.',
                'rating' => 5,
                'is_featured' => true,
                'sort_order' => 20,
            ],
            [
                'customer_name' => 'H. Santosa',
                'company' => 'Griya Resort & Spa Yogyakarta',
                'industry' => 'Hospitality',
                'photo' => 'https://picsum.photos/seed/demo03/200/200',
                'quote' => 'Investasi terbaik yang pernah kami lakukan untuk dapur hotel. Efisiensi energi dan kualitas masakan benar-benar di atas ekspektasi. Staf dapur kami sangat terbantu.',
                'rating' => 5,
                'is_featured' => true,
                'sort_order' => 30,
            ],
            [
                'customer_name' => 'R. Utami',
                'company' => 'Warung Nusantara Authentic Dining',
                'industry' => 'Restoran',
                'photo' => 'https://picsum.photos/seed/demo04/200/200',
                'quote' => 'Kami telah menggunakan oven Kitchen selama 3 tahun dan tidak pernah kecewa. Perawatannya mudah dan hasilnya selalu sempurna. Tim support juga sangat responsif.',
                'rating' => 5,
                'is_featured' => false,
                'sort_order' => 40,
            ],
            [
                'customer_name' => 'B. Pradipta',
                'company' => 'Taman Fine Dining Bandung',
                'industry' => 'Fine Dining',
                'photo' => 'https://picsum.photos/seed/demo05/200/200',
                'quote' => 'Dari semua oven komersial yang pernah kami gunakan, Kitchen adalah yang paling andal. Fitur self-cleaning-nya menghemat banyak waktu staf dapur kami setiap harinya.',
                'rating' => 5,
                'is_featured' => false,
                'sort_order' => 50,
            ],
            [
                'customer_name' => 'D. Lestari',
                'company' => 'Dapur Manis Pastry & Cake',
                'industry' => 'Pastry Shop',
                'photo' => 'https://picsum.photos/seed/demo06/200/200',
                'quote' => 'Kami membuka cabang baru dan langsung menggunakan Kitchen di semua outlet. Standarisasi rasa antar cabang jadi lebih mudah dengan teknologi presisi mereka.',
                'rating' => 4,
                'is_featured' => false,
                'sort_order' => 60,
            ],
            [
                'customer_name' => 'F. Nugroho',
                'company' => 'Hotel Bintang Semarang',
                'industry' => 'Hotel',
                'photo' => 'https://picsum.photos/seed/demo07/200/200',
                'quote' => 'Chef kami sangat puas dengan presisi suhu oven Kitchen. Tidak ada lagi keluhan tentang kematangan yang tidak merata. Game changer untuk dapur profesional kami!',
                'rating' => 5,
                'is_featured' => false,
                'sort_order' => 70,
            ],
            [
                'customer_name' => 'M. Hidayat',
                'company' => 'Restoran Mie Khas Nusantara',
                'industry' => 'Restoran',
                'photo' => 'https://picsum.photos/seed/demo08/200/200',
                'quote' => 'Pelanggan kami langsung merasakan perbedaan sejak kami beralih ke Kitchen. Tekstur dan rasa lebih baik, dan kami bisa melayani lebih banyak pesanan setiap harinya.',
                'rating' => 4,
                'is_featured' => false,
                'sort_order' => 80,
            ],
            [
                'customer_name' => 'T. Anggraini',
                'company' => 'Villa Bukit Bali Resort',
                'industry' => 'Hospitality',
                'photo' => 'https://picsum.photos/seed/demo09/200/200',
                'quote' => 'Dukungan teknis Kitchen di Indonesia sangat membantu. Mereka datang langsung untuk training staf kami. Layanan purna jual yang luar biasa dan sangat profesional.',
                'rating' => 5,
                'is_featured' => false,
                'sort_order' => 90,
            ],
            [
                'customer_name' => 'W. Setiawan',
                'company' => 'Prima Catering & Events',
                'industry' => 'Catering',
                'photo' => 'https://picsum.photos/seed/demo10/200/200',
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
