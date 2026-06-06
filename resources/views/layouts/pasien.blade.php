<!DOCTYPE html>
<html>
<head>
    <title>Sistem Reservasi Dokter</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-dark bg-primary">
    <div class="container-fluid">

        <span class="navbar-brand">
            Sistem Reservasi Dokter
        </span>

        <span class="text-white">
            {{ auth()->user()->nama }}
        </span>

    </div>
</nav>

<div class="container-fluid">

    <div class="row">

        <div class="col-md-2 bg-light min-vh-100">

            <h5 class="mt-3">Menu Pasien</h5>

            <ul class="nav flex-column">

                <li class="nav-item">
                    <a href="/pasien/dashboard" class="nav-link">
                        Dashboard
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/pasien/reservasi" class="nav-link">
                        Reservasi
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/pasien/riwayat" class="nav-link">
                        Riwayat Reservasi
                    </a>
                </li>

                <li class="nav-item">
                    <a href="/pasien/profil" class="nav-link">
                        Profil
                    </a>
                </li>

            </ul>

        </div>

        <div class="col-md-10 p-4">

            @yield('content')

        </div>

    </div>

</div>

</body>
</html>