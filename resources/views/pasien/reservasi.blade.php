@extends('layouts.pasien')

@section('content')

<h2>Jadwal Praktik Dokter</h2>

<table class="table">

    <thead>
        <tr>
            <th>Dokter</th>
            <th>Hari</th>
            <th>Tanggal</th>
            <th>Jam</th>
            <th>Kuota</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

    @foreach($jadwal as $item)

        <tr>

            <td>{{ $item->dokter->nama }}</td>

            <td>{{ $item->hari }}</td>

            <td>{{ $item->tanggal }}</td>

            <td>
                {{ $item->jam_mulai }}
                -
                {{ $item->jam_selesai }}
            </td>

            <td>{{ $item->kuota_pasien }}</td>

            <td>

                <button
                    class="btn btn-primary">

                    Reservasi

                </button>

            </td>

        </tr>

    @endforeach

    </tbody>

</table>

@endsection