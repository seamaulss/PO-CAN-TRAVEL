@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Pesan Tiket</h2>

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        {{-- Pilih Bus --}}
        <div class="mb-3">
            <label for="bus-select" class="form-label">Pilih Bus:</label>
            <select name="bus_id" id="bus-select" class="form-select" required>
                <option value="">-- Pilih Bus --</option>
                @foreach($buses as $bus)
                    <option value="{{ $bus->id }}">
                        {{ $bus->bus_name }} ({{ $bus->route_from }} → {{ $bus->route_to }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Pilih Kursi (diisi via AJAX) --}}
        <div class="mb-3">
            <label for="seat-select" class="form-label">Pilih Kursi:</label>
            <select name="seat_id" id="seat-select" class="form-select" required>
                <option value="">-- Pilih Kursi --</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Pesan Tiket</button>
    </form>
</div>

<script>
const busSelect  = document.getElementById('bus-select');
const seatSelect = document.getElementById('seat-select');

busSelect.addEventListener('change', function () {
    const busId = this.value;

    // reset isi kursi
    seatSelect.innerHTML = '<option value="">Loading...</option>';

    if (!busId) {
        seatSelect.innerHTML = '<option value="">-- Pilih Kursi --</option>';
        return;
    }

    fetch(`/api/bus/${busId}/seats`)
        .then(res => res.json())
        .then(data => {
            // opsi default
            seatSelect.innerHTML = '<option value="">-- Pilih Kursi --</option>';

            if (!Array.isArray(data) || data.length === 0) {
                const opt = document.createElement('option');
                opt.value = '';
                opt.textContent = 'Tidak ada kursi tersedia';
                seatSelect.appendChild(opt);
                return;
            }

            data.forEach(seat => {
                const opt = document.createElement('option');
                opt.value = seat.id;                 // kirim seat_id ke backend
                opt.textContent = seat.seat_number;  // tampilkan nomor kursi
                seatSelect.appendChild(opt);
            });
        })
        .catch(err => {
            console.error('Gagal mengambil kursi:', err);
            seatSelect.innerHTML = '<option value="">-- Gagal load kursi --</option>';
        });
});
</script>
@endsection
