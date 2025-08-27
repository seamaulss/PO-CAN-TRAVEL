<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Sistem Pemesanan Tiket Bus</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="container mx-auto p-6">
        <header class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">PO Can Travel</h1>
            
            @auth
                <a href="{{ route('orders.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded">Pesanan Saya</a>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 bg-green-600 text-white rounded">Login</a>
                <a href="{{ route('register') }}" class="ml-2 px-4 py-2 bg-blue-600 text-white rounded">Register</a>
            @endauth
        </header>

        <h2 class="text-xl font-semibold mb-4">Jadwal Bus</h2>

        <table class="w-full border border-gray-300 bg-white rounded-lg">
            <thead>
                <tr class="bg-gray-200">
                    <th class="p-2 border">Nama Bus</th>
                    <th class="p-2 border">Rute</th>
                    <th class="p-2 border">Harga</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($buses as $bus)
                <tr>
                    <td class="p-2 border">{{ $bus->bus_name }}</td>
                    <td class="p-2 border">{{ $bus->route_from }} → {{ $bus->route_to }}</td>
                    <td class="p-2 border">Rp {{ number_format($bus->price, 0, ',', '.') }}</td>
                    <td class="p-2 border">
                        @auth
                            <a href="{{ route('orders.create', $bus->id) }}" class="px-3 py-1 bg-blue-500 text-white rounded">Pesan</a>
                        @else
                            <a href="{{ route('login') }}" class="px-3 py-1 bg-gray-500 text-white rounded">Login untuk Pesan</a>
                        @endauth
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
