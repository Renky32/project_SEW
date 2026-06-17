@if(session('error'))

<div class="alert alert-danger">

    {{ session('error') }}

</div>

@endif

@if(session('success'))

<div class="alert alert-success">

    {{ session('success') }}

</div>

@endif

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>Login - Sistem Reservasi Dokter</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container">

        <div class="row justify-content-center align-items-center vh-100">

            <div class="col-md-5">

                <div class="card shadow">

                    <div class="card-header text-center bg-primary text-white">

                        <h3>Sistem Reservasi Praktik Dokter</h3>

                    </div>

                    <div class="card-body p-4">

                        <form action="{{ route('login') }}" method="POST">

                            @csrf

                            <div class="mb-3">

                                <label class="form-label">
                                    Username/Email
                                </label>

                                <input
                                    type="text"
                                    name="username"
                                    class="form-control"
                                    required>
                                @error('username')

                                <div class="text-danger">

                                    {{ $message }}

                                </div>

                                @enderror

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    required>
                                @error('password')

                                <div class="text-danger">

                                    {{ $message }}

                                </div>

                                @enderror

                            </div>

                            <button
                                type="submit"
                                class="btn btn-primary w-100">

                                Login

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>