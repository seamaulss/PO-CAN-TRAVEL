<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Bus;
use App\Models\Seat;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalOrders' => Order::count(),
            'totalBuses'  => Bus::count(),
            'totalSeats'  => Seat::count(),
        ]);
    }
}
