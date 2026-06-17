@extends('layouts.pasien')

@section('content')

<h2>Dashboard Pasien</h2>
Selamat datang,
{{ auth()->user()->nama }}
<br>
Email:
{{ auth()->user()->email }}
<br><br>
No HP:
{{ auth()->user()->no_hp }}<div class="row">

    <div class="col-md-3 mb-3">

        <div class="card text-white bg-primary shadow">

            <div class="card-body">

                <h5 class="card-title">
                    Total Reservasi
                </h5>

                <h2>
                    {{ $totalReservasi }}
                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card text-white bg-warning shadow">

            <div class="card-body">

                <h5 class="card-title">
                    Menunggu
                </h5>

                <h2>
                    {{ $reservasiAktif }}
                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card text-white bg-success shadow">

            <div class="card-body">

                <h5 class="card-title">
                    Selesai
                </h5>

                <h2>
                    {{ $reservasiSelesai }}
                </h2>

            </div>

        </div>

    </div>

    <div class="col-md-3 mb-3">

        <div class="card text-white bg-danger shadow">

            <div class="card-body">

                <h5 class="card-title">
                    Dibatalkan
                </h5>

                <h2>
                    {{ $reservasiBatal }}
                </h2>

            </div>

        </div>

    </div>

</div>

<div class="card shadow mt-4">

    <div class="card-header">

        <h5 class="mb-0">
            Reservasi Terdekat
        </h5>

    </div>

    <div class="card-body">

        <table class="table table-striped">

            <thead>

                <tr>

                    <th>Dokter</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Antrian</th>
                    <th>Status</th>

                </tr>

            </thead>

            <tbody>

            @forelse($reservasiTerdekat as $item)

                <tr>

                    <td>
                        {{ $item->jadwal->dokter->nama }}
                    </td>

                    <td>
                        {{ \Carbon\Carbon::parse($item->tanggal_booking)->format('d-m-Y') }}
                    </td>

                    <td>
                        {{ $item->jadwal->jam_mulai }}
                        -
                        {{ $item->jadwal->jam_selesai }}
                    </td>

                    <td>
                        {{ $item->nomor_antrian }}
                    </td>

                    <td>

                        <span class="badge bg-warning">

                            {{ ucfirst($item->status_reservasi) }}

                        </span>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5">

                        Tidak ada reservasi aktif.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection