<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Pelaporan MBG</title>
</head>
<body style="font-family: sans-serif; padding: 2rem; max-width: 1000px; margin: auto;">
    <header style="display: flex; justify-content: space-between; border-bottom: 2px solid #ccc; padding-bottom: 1rem; margin-bottom: 2rem;">
        <h1>Pelaporan MBG</h1>
        <div style="text-align: right;">
            @auth
                Halo, {{ auth()->user()->name }} ({{ auth()->user()->role }})<br>
                <a href="{{ route('laporan.index') }}">Beranda Laporan</a>
            @endauth
        </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>
</html>