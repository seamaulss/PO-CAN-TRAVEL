<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;
use App\Models\Seat;

class BusSeeder extends Seeder
{
    public function run(): void
    {
        // Bus 1
        $bus1 = Bus::create([
            'bus_name'   => 'PO Can Travel',
            'route_from' => 'Jakarta',
            'route_to'   => 'Bandung',
            'price'      => 50000,
            'departure_time' => '2025-08-26 14:00:00',
        ]);

        // Kursi bus 1
        foreach(['A1','A2','A3','A4','A5'] as $seatNumber) {
            Seat::create([
                'bus_id' => $bus1->id,
                'seat_number'   => $seatNumber,
            ]);
        }

        // Bus 2
        $bus2 = Bus::create([
            'bus_name'   => 'PO Can Travel',
            'route_from' => 'Bandung',
            'route_to'   => 'Jakarta',
            'price'      => 50000,
            'departure_time' => '2025-07-26 14:00:00',
        ]);

        // Kursi bus 2
        foreach(['B1','B2','B3','B4','B5'] as $seatNumber) {
            Seat::create([
                'bus_id' => $bus2->id,
                'seat_number'   => $seatNumber,
            ]);
        }
    }
}
