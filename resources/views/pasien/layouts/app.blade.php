<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Patient Dashboard') - Medical Consultation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gradient-to-b from-blue-900 to-blue-800 text-white shadow-lg">
            <div class="p-6 border-b border-blue-700">
                <div class="flex items-center space-x-2">
                    <div class="w-10 h-10 bg-blue-400 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-injured text-white"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold">Medical</h1>
                        <p class="text-xs text-blue-200">Patient Portal</p>
                    </div>
                </div>
            </div>

            <nav class="p-4 space-y-2">
                <a href="{{ route('pasien.dashboard') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('pasien.dashboard') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('pasien.doctors.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('pasien.doctors.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-user-md w-5"></i>
                    <span>Daftar Dokter</span>
                </a>

                <a href="{{ route('pasien.consultations.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('pasien.consultations.*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-calendar-check w-5"></i>
                    <span>Konsultasi Saya</span>
                </a>

                <a href="{{ route('pasien.profile') }}" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition {{ request()->routeIs('pasien.profile*') ? 'bg-blue-700' : '' }}">
                    <i class="fas fa-user-circle w-5"></i>
                    <span>Profil</span>
                </a>
            </nav>

            <!-- Footer -->
            <div class="absolute bottom-0 w-64 p-4 border-t border-blue-700">
                <form action="{{ route('logout') }}" method="POST" class="w-full">
                    @csrf
                    <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition text-left">
                        <i class="fas fa-sign-out-alt w-5"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <div class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center shadow-sm">
                <h2 class="text-2xl font-bold text-gray-800">@yield('page-title', 'Dashboard')</h2>
                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm font-semibold text-gray-700">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                    </div>
                    <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="flex-1 overflow-auto p-8">
                @if ($message = Session::get('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-3"></i>
                            <p class="text-green-700 font-semibold">{{ $message }}</p>
                        </div>
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                            <p class="text-red-700 font-semibold">{{ $message }}</p>
                        </div>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
