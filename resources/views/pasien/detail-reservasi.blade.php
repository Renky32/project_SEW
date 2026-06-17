@extends('layouts.pasien')

@section('content')

<h2>Detail Reservasi</h2>

<table class="table">

    <tr>
        <th>Dokter</th>
        <td>{{ $reservasi->jadwal->dokter->nama }}</td>
    </tr>

    <tr>
        <th>Hari Praktik</th>
        <td>{{ $reservasi->jadwal->hari }}</td>
    </tr>

    <tr>
        <th>Tanggal Praktik</th>
        <td>{{ \Carbon\Carbon::parse($item->tanggal_booking)->format('d-m-Y') }}</td>
    </tr>

    <tr>
        <th>Jam</th>
        <td>
            {{ $reservasi->jadwal->jam_mulai }}
            -
            {{ $reservasi->jadwal->jam_selesai }}
        </td>
    </tr>

    <tr>
        <th>Nomor Antrian</th>
        <td>{{ $reservasi->nomor_antrian }}</td>
    </tr>

    <tr>
        <th>Status</th>
        <td>{{ $reservasi->status_reservasi }}</td>
    </tr>

    <tr>
        <th>Tanggal Booking</th>
        <td>{{ $reservasi->tanggal_booking }}</td>
    </tr>



</table>
@if($reservasi->status_reservasi == 'Menunggu')

<form
    action="/pasien/reservasi/{{ $reservasi->id_reservasi }}/batal"
    method="POST"
    onsubmit="return confirm('Yakin ingin membatalkan reservasi ini?')">

    @csrf
    @method('PUT')

    <button
        type="submit"
        class="btn btn-danger">

        Batalkan Reservasi

    </button>

</form>

@endif
@endsection