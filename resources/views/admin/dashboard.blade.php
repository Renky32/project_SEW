<h1>Dashboard Staff</h1>

<p>Selamat datang {{ auth()->user()->nama }}</p>

<form action="{{ route('logout') }}" method="POST">
    @csrf

    <button type="submit" class="btn btn-danger">
        Logout
    </button>
</form>