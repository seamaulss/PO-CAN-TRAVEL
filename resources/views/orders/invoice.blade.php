<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice Order #{{ $order->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        .total { text-align: right; font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>🚌 PO Can Travel</h2>
        <p>Invoice Tiket Bus</p>
    </div>

    <p><strong>No. Invoice:</strong> INV-{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
    <p><strong>Tanggal Pesan:</strong> {{ $order->created_at->format('d M Y H:i') }}</p>
    <p><strong>Nama Pemesan:</strong> {{ $order->user->name }}</p>

    <table>
        <tr>
            <th>Bus</th>
            <td>{{ $order->bus->bus_name }}</td>
        </tr>
        <tr>
            <th>Rute</th>
            <td>{{ $order->bus->route_from }} → {{ $order->bus->route_to }}</td>
        </tr>
        <tr>
            <th>No. Kursi</th>
            <td>{{ $order->seat->seat_number }}</td>
        </tr>
        <tr>
            <th>Harga</th>
            <td>Rp{{ number_format($order->bus->price,0,',','.') }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ ucfirst($order->status) }}</td>
        </tr>
    </table>

    <p class="total">Total: Rp{{ number_format($order->bus->price,0,',','.') }}</p>

    <p><em>Terima kasih telah memesan tiket di PO Can Travel.</em></p>
</body>
</html>
