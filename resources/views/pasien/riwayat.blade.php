@extends('layouts.pasien')

@section('content')

<h2>Riwayat Reservasi</h2>
@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<table class="table table-bordered">

    <thead>

        <tr>
            <th>Dokter</th>
            <th>Tanggal Booking</th>
            <th>Hari Praktik</th>
            <th>Nomor Antrian</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

    </thead>

    <tbody>

        @forelse($reservasi as $item)

        <tr>

            <td>
                {{ $item->jadwal->dokter->nama }}
            </td>

            <td>
                {{ $item->tanggal_booking }}
            </td>

            <td>
                {{ $item->jadwal->hari }}
            </td>

            <td>
                {{ $item->nomor_antrian }}
            </td>

            <td>@if($item->status_reservasi == 'menunggu')

                <span class="badge bg-warning">
                    Menunggu
                </span>

                @elseif($item->status_reservasi == 'dikonfirmasi')

                <span class="badge bg-success">
                    Dikonfirmasi
                </span>

                @elseif($item->status_reservasi == 'selesai')

                <span class="badge bg-primary">
                    Selesai
                </span>

                @elseif($item->status_reservasi == 'dibatalkan')

                <span class="badge bg-secondary">
                    Dibatalkan
                </span>

                @elseif($item->status_reservasi == 'ditolak')

                <span class="badge bg-danger">
                    Ditolak
                </span>

                @endif
            </td>
            <td>

                <a
                    href="/pasien/riwayat/{{ $item->id_reservasi }}"
                    class="btn btn-info">

                    Detail

                </a>

            </td>

        </tr>

        @empty

        <tr>

            <td colspan="5">
                Belum ada riwayat reservasi.
            </td>

        </tr>

        @endforelse

    </tbody>

</table>

@endsection