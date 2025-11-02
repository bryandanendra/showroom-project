<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\Category;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            [
                'category_id' => Category::where('slug', 'mpv')->first()->id,
                'brand' => 'Toyota',
                'model' => 'Avanza',
                'year' => 2019,
                'color' => 'Silver',
                'transmission' => 'manual',
                'fuel_type' => 'bensin',
                'mileage' => 45000,
                'price' => 165000000,
                'license_plate' => 'B 1234 ABC',
                'engine_capacity' => 1300,
                'passengers' => 7,
                'description' => 'Toyota Avanza 2019 kondisi terawat, service rutin di bengkel resmi. Interior bersih dan rapi.',
                'features' => 'AC, Power Steering, Central Lock, Electric Mirror, Audio System',
                'condition' => 'excellent',
                'status' => 'available',
            ],
            [
                'category_id' => Category::where('slug', 'suv')->first()->id,
                'brand' => 'Honda',
                'model' => 'CR-V',
                'year' => 2018,
                'color' => 'Putih',
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'mileage' => 60000,
                'price' => 325000000,
                'license_plate' => 'B 5678 XYZ',
                'engine_capacity' => 2000,
                'passengers' => 7,
                'description' => 'Honda CR-V Turbo 2018, kondisi istimewa. Pajak panjang, siap pakai.',
                'features' => 'Sunroof, Leather Seats, Cruise Control, Parking Sensor, Camera, Turbo Engine',
                'condition' => 'excellent',
                'status' => 'available',
            ],
            [
                'category_id' => Category::where('slug', 'sedan')->first()->id,
                'brand' => 'Honda',
                'model' => 'Civic',
                'year' => 2017,
                'color' => 'Hitam',
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'mileage' => 75000,
                'price' => 285000000,
                'license_plate' => 'B 9012 DEF',
                'engine_capacity' => 1500,
                'passengers' => 5,
                'description' => 'Honda Civic Turbo 2017, mesin halus, interior mewah. Cocok untuk eksekutif muda.',
                'features' => 'Turbo Engine, Leather Seats, Sunroof, Premium Audio, LED Lights',
                'condition' => 'good',
                'status' => 'available',
            ],
            [
                'category_id' => Category::where('slug', 'mpv')->first()->id,
                'brand' => 'Daihatsu',
                'model' => 'Xenia',
                'year' => 2020,
                'color' => 'Merah',
                'transmission' => 'manual',
                'fuel_type' => 'bensin',
                'mileage' => 30000,
                'price' => 155000000,
                'license_plate' => 'B 3456 GHI',
                'engine_capacity' => 1300,
                'passengers' => 7,
                'description' => 'Daihatsu Xenia 2020 seperti baru, kilometer rendah. Cocok untuk keluarga.',
                'features' => 'AC Double Blower, Power Window, Central Lock, Audio Touchscreen',
                'condition' => 'excellent',
                'status' => 'available',
            ],
            [
                'category_id' => Category::where('slug', 'suv')->first()->id,
                'brand' => 'Mitsubishi',
                'model' => 'Pajero Sport',
                'year' => 2016,
                'color' => 'Abu-abu',
                'transmission' => 'automatic',
                'fuel_type' => 'diesel',
                'mileage' => 95000,
                'price' => 315000000,
                'license_plate' => 'B 7890 JKL',
                'engine_capacity' => 2500,
                'passengers' => 7,
                'description' => 'Pajero Sport Dakar 2016, mesin diesel irit dan bertenaga. Full original.',
                'features' => '4WD, Leather Seats, Parking Camera, Electric Seat, Premium Audio',
                'condition' => 'good',
                'status' => 'available',
            ],
            [
                'category_id' => Category::where('slug', 'hatchback')->first()->id,
                'brand' => 'Honda',
                'model' => 'Jazz',
                'year' => 2019,
                'color' => 'Putih',
                'transmission' => 'automatic',
                'fuel_type' => 'bensin',
                'mileage' => 40000,
                'price' => 215000000,
                'license_plate' => 'B 2468 MNO',
                'engine_capacity' => 1500,
                'passengers' => 5,
                'description' => 'Honda Jazz RS 2019, sporty dan irit. Cocok untuk anak muda.',
                'features' => 'Paddle Shift, Touchscreen Audio, Rear Camera, Keyless Entry, Push Start',
                'condition' => 'excellent',
                'status' => 'available',
            ],
        ];

        foreach ($cars as $car) {
            Car::create($car);
        }
    }
}
