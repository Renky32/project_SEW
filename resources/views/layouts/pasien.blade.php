<!DOCTYPE html>
<html>

<head>
    <title>Sistem Reservasi Dokter</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <nav class="navbar navbar-dark bg-primary">
        <div class="container-fluid">

            <span class="navbar-brand">
                Sistem Reservasi Dokter
            </span>

            <div class="dropdown">

                <a
                    class="text-white text-decoration-none dropdown-toggle"
                    href="#"
                    role="button"
                    data-bs-toggle="dropdown">

                    {{ auth()->user()->nama }}

                    <form
                        action="{{ route('logout') }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin keluar dari aplikasi?')">

                        @csrf

                    </form>

                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>

                        <a
                            class="dropdown-item"
                            href="/pasien/profil">

                            Profil

                        </a>

                    </li>

                    <li>

                        <hr class="dropdown-divider">

                    </li>

                    <li>

                        <form
                            action="{{ route('logout') }}"
                            method="POST">

                            @csrf

                            <button
                                type="submit"
                                class="dropdown-item text-danger">

                                Logout

                            </button>

                        </form>

                    </li>

                </ul>

            </div>

        </div>
    </nav>

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-2 bg-light min-vh-100">

                <h5 class="mt-3">Menu Pasien</h5>

                <ul class="nav flex-column">

                    <li class="nav-item">
                        <a
                            href="/pasien/dashboard"
                            class="nav-link {{ request()->is('pasien/dashboard') ? 'active fw-bold text-primary' : '' }}">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="/pasien/reservasi"
                            class="nav-link {{ request()->is('pasien/reservasi') ? 'active fw-bold text-primary' : '' }}">
                            Reservasi
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="/pasien/riwayat"
                            class="nav-link {{ request()->is('pasien/riwayat*') ? 'active fw-bold text-primary' : '' }}">
                            Riwayat Reservasi
                        </a>
                    </li>

                    <li class="nav-item">
                        <a
                            href="/pasien/profil"
                            class="nav-link {{ request()->is('pasien/profil') ? 'active fw-bold text-primary' : '' }}">
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