@extends('layouts.app')

@section('content')
    <h2>Pesanan Saya</h2>

    {{-- Flash message --}}
    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div style="color: red;">{{ session('error') }}</div>
    @endif

    @if($orders->count() > 0)
        <table border="1" cellpadding="5" style="width:100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th>Bus</th>
                    <th>Rute</th>
                    <th>Kursi</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Tanggal Pesan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->bus->bus_name }}</td>
                        <td>{{ $order->bus->route_from }} → {{ $order->bus->route_to }}</td>
                        <td>{{ $order->seat->seat_number }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            @if($order->status !== 'paid')
                                {{-- Form bayar --}}
                                <form action="{{ route('orders.pay', $order->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <select name="payment_method" required>
                                        <option value="cash">Cash</option>
                                        <option value="transfer">Transfer</option>
                                        <option value="ewallet">E-Wallet</option>
                                    </select>
                                    <button type="submit">Bayar</button>
                                </form>
                            @else
                                {{-- Link unduh tiket --}}
                                <a href="{{ route('orders.invoice', $order->id) }}" target="_blank">Unduh Invoice</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada pesanan.</p>
    @endif
@endsection
