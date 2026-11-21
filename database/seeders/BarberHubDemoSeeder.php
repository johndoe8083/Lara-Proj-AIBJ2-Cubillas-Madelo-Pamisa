<?php

namespace Database\Seeders;

use App\Models\Barber;
use App\Models\BarberSchedule;
use App\Models\Service;
use Illuminate\Database\Seeder;

class BarberHubDemoSeeder extends Seeder
{
    public function run(): void
    {
        // Ten active services are seeded with updateOrCreate so rerunning
        // `php artisan db:seed` updates these records without duplicating them.
        $services = [
            ['Classic Haircut', 'A clean and timeless cut for a sharp look.', 150, 30, 'images/services/service-1.jpg'],
            ['Skin Fade', 'A modern fade for a neat and stylish finish.', 200, 45, 'images/services/service-2.jpg'],
            ['Haircut + Beard', 'A complete grooming package for a refined look.', 300, 60, 'images/services/service-3.jpg'],
            ['Beard Trim', 'Shape and maintain your beard with precision.', 100, 20, 'images/services/service-4.jpg'],
            ['Hot Towel Shave', 'A relaxing, close shave with a soothing hot towel treatment.', 180, 30, 'images/services/service-5.jpg'],
            ['Buzz Cut', 'A low-maintenance, evenly clipped haircut with a crisp finish.', 120, 20, 'images/services/service-6.jpg'],
            ['Crew Cut', 'A timeless short haircut with a neat, tapered finish.', 150, 30, 'images/services/service-7.jpg'],
            ['Custom Cut', 'A personalized haircut designed around your reference photo, preferred length, texture, and style. Final price is quoted by the barber after reviewing the requested haircut.', 0, 60, 'images/services/service-11.jpg'],
            ['Hair Wash & Style', 'A refreshing shampoo followed by a neat, tailored style.', 120, 25, 'images/services/service-9.jpg'],
            ['Hair Coloring', 'Professional single-tone hair color for a refreshed look.', 500, 90, 'images/services/service-10.jpg'],
        ];

        // Retire the removed service so it no longer appears in active service listings.
        Service::where('name', 'Pompadour Styling')->update(['is_active' => false]);

        foreach ($services as [$name, $description, $price, $duration, $image]) {
            Service::updateOrCreate(['name' => $name], [
                'description' => $description,
                'price' => $price,
                'is_custom_priced' => $name === 'Custom Cut',
                'duration_minutes' => $duration,
                'image' => $image,
                'is_active' => true,
            ]);
        }

        $barbers = [
            ['Marco Reyes', 'Senior Barber', 'Precision fades and classic cuts.', 'images/barbers/barber-1.jpg'],
            ['Jovanni Santos', 'Master Barber', 'Tapers, texture and modern styling.', 'images/barbers/barber-2.jpg'],
            ['Ethan Cruz', 'Barber', 'Clean classics and crew cuts.', 'images/barbers/barber-3.jpg'],
            ['Kyle Mendoza', 'Barber', 'Textured crops and contemporary fades.', 'images/barbers/barber-4.jpg'],
            ['Rafael Dela Cruz', 'Senior Barber', 'Beard grooming and traditional shaves.', 'images/barbers/barber-5.jpg'],
        ];

        foreach ($barbers as [$name, $specialty, $bio, $photo]) {
            $barber = Barber::updateOrCreate(['name' => $name], [
                'specialty' => $specialty,
                'bio' => $bio,
                'photo' => $photo,
                'is_active' => true,
            ]);

            for ($day = 1; $day <= 6; $day++) {
                BarberSchedule::updateOrCreate(
                    ['barber_id' => $barber->id, 'day_of_week' => $day],
                    ['start_time' => '09:00:00', 'end_time' => '18:00:00', 'is_day_off' => false]
                );
            }

            BarberSchedule::updateOrCreate(
                ['barber_id' => $barber->id, 'day_of_week' => 0],
                ['start_time' => '09:00:00', 'end_time' => '18:00:00', 'is_day_off' => true]
            );
        }
    }
}
