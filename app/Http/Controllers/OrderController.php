<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Bus;
use App\Models\Seat;
use App\Models\Order;

class OrderController extends Controller
{
    public function getSeats($busId)
{
    return Seat::where('bus_id', $busId)
        ->where('is_booked', 0)
        ->get(['id', 'seat_number']);
}

    public function create()
{
    $buses = Bus::orderBy('bus_name')->get();
    return view('orders.create', compact('buses'));
}


    public function index()
{
    $orders = Order::with(['bus', 'seat'])->latest()->get();
    return view('orders.index', compact('orders'));
}




    public function invoice($id)
    {
        $order = Order::with(['bus', 'seat'])->findOrFail($id);

        // hanya boleh download invoice kalau status sudah paid
        if ($order->status !== 'paid') {
            return redirect()->back()->with('error', 'Invoice hanya bisa diunduh setelah pembayaran.');
        }

        $pdf = Pdf::loadView('orders.invoice', compact('order')) // ✅ ubah ke 'orders.invoice'
                  ->setPaper('a4', 'portrait');

        return $pdf->download('Invoice-Order-' . $order->id . '.pdf');
    }

    public function pay(Order $order)
    {
        // pastikan order milik user yang login
        if ($order->user_id !== auth()->id()) {
            return redirect()->route('orders.history')->with('error', 'Tidak boleh membayar pesanan orang lain!');
        }

        // update status jadi paid
        $order->update([
            'status' => 'paid'
        ]);

        return redirect()->route('orders.history')->with('success', 'Pembayaran berhasil, tiket Anda sudah aktif!');
    }

    public function history()
    {
        $orders = Order::with(['bus', 'seat'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders.history', compact('orders')); // ✅ ubah ke 'orders.history'
    }

    public function store(Request $request)
{
    $request->validate([
        'bus_id'  => 'required|exists:buses,id',
        'seat_id' => 'required|exists:seats,id',
    ]);

    // Ambil harga bus
    $bus = Bus::findOrFail($request->bus_id);
    $price = $bus->price; // pastikan field harga di tabel buses namanya 'price'

    $order = Order::create([
        'bus_id'      => $request->bus_id,
        'seat_id'     => $request->seat_id,
        'user_id'     => auth()->id(),
        'status'      => 'Dipesan',
        'total_price' => $price, // ⬅️ wajib diisi
    ]);

    // update kursi jadi terpesan
    Seat::where('id', $request->seat_id)->update(['is_booked' => 1]);

    return redirect()->route('orders.index')->with('success', 'Tiket berhasil dipesan!');
}


}
