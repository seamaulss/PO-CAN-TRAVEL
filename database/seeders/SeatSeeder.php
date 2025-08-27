<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;
use App\Models\Seat;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buses = Bus::all();

        foreach ($buses as $bus) {
            for ($i = 1; $i <= 10; $i++) {
                $seatNumber = chr(64 + ceil($i / 5)) . ($i % 5 == 0 ? 5 : $i % 5);
                Seat::firstOrCreate([
                    'bus_id'      => $bus->id,
                    'seat_number' => $seatNumber,
                ], [
                    'is_booked'   => 0,
                ]);
            }
        }
    }
}
