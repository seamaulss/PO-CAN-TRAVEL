<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_name',
        'route_from',
        'route_to',
        'departure_time',
        'price',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function seats()
    {
        return $this->hasMany(Seat::class);
    }
}
