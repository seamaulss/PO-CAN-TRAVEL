@extends('layouts.app')

@section('content')
    <h2>Pesanan Saya</h2>

    @if(session('success'))
        <div style="color: green;">{{ session('success') }}</div>
    @endif

    @if($orders->count() > 0)
        <table border="1" cellpadding="5">
            <tr>
                <th>Bus</th>
                <th>Rute</th>
                <th>Kursi</th>
                <th>Status</th>
                <th>Tanggal Pesan</th>
            </tr>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->bus->bus_name }}</td>
                    <td>{{ $order->bus->route_from }} → {{ $order->bus->route_to }}</td>
                    <td>{{ $order->seat->seat_number }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                </tr>
            @endforeach
        </table>
    @else
        <p>Belum ada pesanan.</p>
    @endif
@endsection
