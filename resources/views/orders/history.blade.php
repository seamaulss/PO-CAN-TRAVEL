@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-5">
    <h2 class="text-2xl font-bold mb-4">Riwayat Pesanan Saya</h2>

    @if($orders->isEmpty())
        <p class="text-gray-600">Belum ada tiket yang dipesan.</p>
    @else
        <table class="w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-300 px-3 py-2">#</th>
                    <th class="border border-gray-300 px-3 py-2">Bus</th>
                    <th class="border border-gray-300 px-3 py-2">Rute</th>
                    <th class="border border-gray-300 px-3 py-2">Kursi</th>
                    <th class="border border-gray-300 px-3 py-2">Harga</th>
                    <th class="border border-gray-300 px-3 py-2">Status & Aksi</th>
                    <th class="border border-gray-300 px-3 py-2">Tanggal Pesan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $index => $order)
                <tr>
                    <td class="border border-gray-300 px-3 py-2">{{ $index + 1 }}</td>
                    <td class="border border-gray-300 px-3 py-2">{{ $order->bus->bus_name }}</td>
                    <td class="border border-gray-300 px-3 py-2">{{ $order->bus->route_from }} → {{ $order->bus->route_to }}</td>
                    <td class="border border-gray-300 px-3 py-2">{{ $order->seat->seat_number }}</td>
                    <td class="border border-gray-300 px-3 py-2">Rp{{ number_format($order->bus->price,0,',','.') }}</td>
                    <td class="border border-gray-300 px-3 py-2">
                        <span class="px-2 py-1 rounded 
                            {{ $order->status == 'paid' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                            {{ ucfirst($order->status) }}
                        </span>

                        {{-- ✅ Tombol Bayar kalau pending --}}
                        @if($order->status == 'pending')
                            <form action="{{ route('orders.pay', $order->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="ml-2 px-3 py-1 bg-blue-500 text-white rounded hover:bg-blue-600">
                                    Bayar
                                </button>
                            </form>
                        @endif

                        {{-- ✅ Tombol Download Invoice kalau sudah paid --}}
                        @if($order->status == 'paid')
                            <a href="{{ route('orders.invoice', $order->id) }}" 
                               class="ml-2 px-3 py-1 bg-green-500 text-white rounded hover:bg-green-600">
                                Download Invoice
                            </a>
                        @endif
                    </td>
                    <td class="border border-gray-300 px-3 py-2">{{ $order->created_at->format('d M Y H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
