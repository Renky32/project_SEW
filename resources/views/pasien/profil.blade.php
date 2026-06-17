@extends('layouts.pasien')

@section('content')

<div class="card shadow">

    <div class="card-header">

        <h4 class="mb-0">
            Profil Pasien
        </h4>

    </div>

    <div class="card-body">

        <div class="row mb-3">

            <div class="col-md-3 fw-bold">
                Nama
            </div>

            <div class="col-md-9">
                {{ auth()->user()->nama }}
            </div>

        </div>

        <div class="row mb-3">

            <div class="col-md-3 fw-bold">
                Email
            </div>

            <div class="col-md-9">
                {{ auth()->user()->email }}
            </div>

        </div>

        <div class="row mb-3">

            <div class="col-md-3 fw-bold">
                Username
            </div>

            <div class="col-md-9">
                {{ auth()->user()->username }}
            </div>

        </div>

        <div class="row mb-3">

            <div class="col-md-3 fw-bold">
                No HP
            </div>

            <div class="col-md-9">
                {{ auth()->user()->no_hp }}
            </div>

        </div>

        <div class="row mb-3">

            <div class="col-md-3 fw-bold">
                Jenis Kelamin
            </div>

            <div class="col-md-9">
                {{ auth()->user()->jenis_kelamin }}
            </div>

        </div>

        <div class="row mb-3">

            <div class="col-md-3 fw-bold">
                Tanggal Lahir
            </div>

            <div class="col-md-9">
                {{ auth()->user()->tanggal_lahir }}
            </div>

        </div>

        <div class="row">

            <div class="col-md-3 fw-bold">
                Alamat
            </div>

            <div class="col-md-9">
                {{ auth()->user()->alamat }}
            </div>

        </div>

    </div>

</div>

@endsection