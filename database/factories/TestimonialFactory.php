<?php

namespace Database\Factories;

use App\Models\Testimonial;
use Illuminate\Database\Eloquent\Factories\Factory;

class TestimonialFactory extends Factory
{
    protected $model = Testimonial::class;

    public function definition(): array
    {
        $names = [
            'Budi Santoso', 'Sari Dewi', 'Agus Wijaya', 'Rina Hartono',
            'Hendra Gunawan', 'Maya Putri', 'Dian Permata', 'Rudi Hermawan',
            'Anisa Rahma', 'Bayu Prasetyo', 'Citra Lestari', 'Dimas Ardian',
        ];

        $companies = [
            'Grand Hyatt Jakarta', 'Hotel Santika Premiere', 'The Westin Resort',
            'Marriott Yogyakarta', 'Plataran Borobudur', 'Restoran Sederhana',
            'Bakmi GM', 'Sate Khas Senayan', 'Holland Bakery', 'Rotiboy',
        ];

        $industries = [
            'Hotel', 'Restoran', 'Bakery', 'Catering', 'Cafe',
            'Hospitality', 'Fine Dining', 'Pastry Shop',
        ];

        $quotes = [
            'Oven BAKOMATIC benar-benar mengubah cara kami bekerja di dapur. Hasil masakan lebih konsisten dan waktu memasak lebih cepat. Sangat direkomendasikan untuk restoran profesional.',
            'Kami telah menggunakan oven BAKOMATIC selama 3 tahun dan tidak pernah kecewa. Perawatannya mudah dan hasilnya selalu sempurna. Tim support juga sangat responsif.',
            'Sebagai pastry chef, konsistensi adalah segalanya. BAKOMATIC memberikan hasil yang sama setiap kali. Kue dan roti kami selalu mengembang sempurna.',
            'Investasi terbaik yang pernah kami lakukan untuk dapur hotel. Efisiensi energi dan kualitas masakan benar-benar di atas ekspektasi.',
            'Dari semua oven komersial yang pernah kami gunakan, BAKOMATIC adalah yang paling andal. Fitur self-cleaning-nya menghemat banyak waktu staf dapur kami.',
            'Kami membuka cabang baru dan langsung menggunakan BAKOMATIC di semua outlet. Standarisasi rasa antar cabang jadi lebih mudah dengan teknologi mereka.',
            'Chef kami sangat puas dengan presisi suhu oven BAKOMATIC. Tidak ada lagi keluhan tentang kematangan yang tidak merata. Game changer untuk dapur profesional!',
            'Pelanggan kami langsung merasakan perbedaan sejak kami beralih ke BAKOMATIC. Tekstur dan rasa lebih baik, dan kami bisa melayani lebih banyak pesanan.',
            'Dukungan teknis BAKOMATIC di Indonesia sangat membantu. Mereka datang langsung untuk training staf kami. Layanan purna jual yang luar biasa.',
            'Sebagai konsultan dapur komersial, saya selalu merekomendasikan BAKOMATIC ke klien. Rasio harga dan performa tidak ada yang menandingi di kelasnya.',
        ];

        return [
            'customer_name' => fake()->randomElement($names),
            'company' => fake()->randomElement($companies),
            'industry' => fake()->randomElement($industries),
            'photo' => 'https://picsum.photos/seed/'.fake()->uuid().'/200/200',
            'quote' => fake()->randomElement($quotes),
            'video_url' => fake()->boolean(20) ? 'https://www.youtube.com/watch?v='.fake()->regexify('[A-Za-z0-9_-]{11}') : null,
            'rating' => fake()->numberBetween(3, 5),
            'is_featured' => fake()->boolean(30),
            'sort_order' => fake()->numberBetween(0, 100),
            'is_active' => fake()->boolean(85),
        ];
    }

    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_active' => false,
        ]);
    }
}
