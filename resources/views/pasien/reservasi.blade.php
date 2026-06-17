@extends('layouts.pasien')

@section('content')

<h2>Jadwal Praktik Dokter</h2>
@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif
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

                <form
                    action="/pasien/reservasi/{{ $item->id_jadwal_praktek }}"
                    method="POST">

                    @csrf

                    <button
                        type="submit"
                        class="btn btn-primary">

                        Reservasi

                    </button>

                </form>

            </td>
        </tr>

        @endforeach

    </tbody>

</table>

@endsection