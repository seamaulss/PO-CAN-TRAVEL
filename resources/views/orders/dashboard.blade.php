{{-- resources/views/dashboard.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-6">
    {{-- Judul --}}
    <h2 class="text-2xl font-bold mb-6">Dashboard</h2>

    {{-- Ringkasan --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-bold">Total Orders</h3>
            <p class="mt-2 text-3xl">{{ $totalOrders ?? 0 }}</p>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-bold">Total Buses</h3>
            <p class="mt-2 text-3xl">{{ $totalBuses ?? 0 }}</p>
        </div>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-bold">Total Seats</h3>
            <p class="mt-2 text-3xl">{{ $totalSeats ?? 0 }}</p>
        </div>
    </div>

    {{-- Aksi cepat --}}
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
        <h3 class="text-lg font-bold mb-4">Aksi Cepat</h3>
        <div class="flex gap-4">
            <a href="{{ route('orders.index') }}" 
                class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Lihat Orders
            </a>
            <a href="{{ route('orders.create') }}" 
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Pesan Tiket
            </a>
            <a href="{{ route('buses.index') }}" 
                class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700">
                Kelola Bus
            </a>
        </div>
    </div>
</div>
@endsection
