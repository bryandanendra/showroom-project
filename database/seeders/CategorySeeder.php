<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'SUV',
                'slug' => 'suv',
                'description' => 'Sport Utility Vehicle - Mobil dengan ground clearance tinggi dan cocok untuk berbagai medan',
            ],
            [
                'name' => 'Sedan',
                'slug' => 'sedan',
                'description' => 'Mobil penumpang dengan desain elegan dan nyaman untuk perjalanan jarak jauh',
            ],
            [
                'name' => 'MPV',
                'slug' => 'mpv',
                'description' => 'Multi Purpose Vehicle - Mobil keluarga dengan kapasitas penumpang besar',
            ],
            [
                'name' => 'Hatchback',
                'slug' => 'hatchback',
                'description' => 'Mobil kompak dengan pintu belakang yang dapat dibuka ke atas',
            ],
            [
                'name' => 'Pick Up',
                'slug' => 'pick-up',
                'description' => 'Mobil dengan bak terbuka di belakang untuk mengangkut barang',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
