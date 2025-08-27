<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentController extends Controller
{
    // Form pilih metode pembayaran
    public function create($orderId)
    {
        $order = Order::with('bus')->findOrFail($orderId);
        return view('payments.create', compact('order'));
    }

    // Proses pembayaran
    public function store(Request $request, $orderId)
    {
        $request->validate([
            'payment_method' => 'required|string'
        ]);

        $order = Order::findOrFail($orderId);

        Payment::create([
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'payment_status' => 'paid', // bisa pending kalau mau diverifikasi manual
            'paid_at' => Carbon::now(),
        ]);

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Pembayaran berhasil dilakukan!');
    }
}
