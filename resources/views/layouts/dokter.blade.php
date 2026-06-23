<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sistem Reservasi Dokter</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --success-color: #16a34a;
            --danger-color: #dc2626;
            --warning-color: #ea580c;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar Styling */
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
        }

        /* Sidebar Styling */
        .sidebar {
            background-color: #1f2937;
            min-height: 100vh;
            padding-top: 2rem;
            position: fixed;
            width: 250px;
            left: 0;
            top: 70px;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar h5 {
            color: #e5e7eb;
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding: 0 1.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .sidebar .nav {
            padding: 0 1rem;
        }

        .sidebar .nav-link {
            color: #9ca3af;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(37, 99, 235, 0.2);
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
        }

        .sidebar .nav-link i {
            font-size: 1.2rem;
            width: 1.5rem;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            margin-top: 70px;
            padding: 2rem;
            min-height: 100vh;
        }

        /* User Info */
        .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--primary-color);
        }

        /* Dashboard Cards */
        .menu-card {
            background: white;
            border-radius: 1rem;
            padding: 2rem;
            text-align: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            cursor: pointer;
            text-decoration: none;
            color: inherit;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .menu-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
            text-decoration: none;
            color: inherit;
        }

        .menu-card-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .menu-card h3 {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1f2937;
        }

        .menu-card p {
            color: #6b7280;
            font-size: 0.95rem;
            margin: 0;
        }

        /* Page Header */
        .page-header {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid #e5e7eb;
        }

        .page-header h1 {
            color: #1f2937;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .page-header h1 i {
            color: var(--primary-color);
            font-size: 2rem;
        }

        /* Table Styling */
        .table-container {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
        }

        .table {
            margin: 0;
        }

        .table thead {
            background-color: #f3f4f6;
            border-bottom: 2px solid #e5e7eb;
        }

        .table thead th {
            color: #374151;
            font-weight: 600;
            padding: 1rem;
            vertical-align: middle;
        }

        .table tbody td {
            padding: 1rem;
            vertical-align: middle;
            color: #4b5563;
        }

        .table tbody tr:hover {
            background-color: #f9fafb;
        }

        /* Badge Styling */
        .badge-schedule {
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-confirmed {
            background-color: #dbeafe;
            color: #0c4a6e;
        }

        .badge-completed {
            background-color: #dcfce7;
            color: #15803d;
        }

        .badge-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* Buttons */
        .btn-action {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            border-radius: 0.5rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .btn-view {
            background-color: #dbeafe;
            color: #0c4a6e;
        }

        .btn-view:hover {
            background-color: #bfdbfe;
            color: #0c4a6e;
            text-decoration: none;
        }

        .btn-edit {
            background-color: #fef3c7;
            color: #92400e;
        }

        .btn-edit:hover {
            background-color: #fde68a;
            color: #92400e;
            text-decoration: none;
        }

        .btn-delete {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .btn-delete:hover {
            background-color: #fca5a5;
            color: #7f1d1d;
            text-decoration: none;
        }

        /* Modal Styling */
        .modal-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
        }

        .modal-header .btn-close {
            filter: brightness(0) invert(1);
        }

        .form-label {
            color: #374151;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-control,
        .form-select {
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
            padding: 0.75rem;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem 2rem;
            background: white;
            border-radius: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .empty-state i {
            font-size: 3rem;
            color: #d1d5db;
            margin-bottom: 1rem;
        }

        .empty-state h5 {
            color: #6b7280;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #9ca3af;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                overflow: hidden;
            }

            .main-content {
                margin-left: 0;
            }

            .menu-card {
                padding: 1.5rem;
            }

            .menu-card-icon {
                font-size: 2rem;
            }
        }
    </style>

    @yield('extra-styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark navbar-custom fixed-top">
        <div class="container-fluid">
            <span class="navbar-brand">
                <i class="bi bi-hospital"></i> Sistem Reservasi Dokter
            </span>
            
            <div class="user-info">
                <span class="text-white">{{ auth()->user()->nama }}</span>
                <div class="user-avatar">
                    {{ substr(auth()->user()->nama, 0, 1) }}
                </div>
                <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-light" title="Logout">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h5 class="mb-3">Menu Dokter</h5>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="/dokter/dashboard" class="nav-link {{ request()->is('dokter/dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dokter/jadwal" class="nav-link {{ request()->is('dokter/jadwal') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check"></i> Lihat Jadwal
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dokter/manajemen" class="nav-link {{ request()->is('dokter/manajemen') ? 'active' : '' }}">
                        <i class="bi bi-clipboard-list"></i> Manajemen Konsultasi
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dokter/update-status" class="nav-link {{ request()->is('dokter/update-status') ? 'active' : '' }}">
                        <i class="bi bi-arrow-repeat"></i> Update Status
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @yield('extra-scripts')
</body>
</html>
