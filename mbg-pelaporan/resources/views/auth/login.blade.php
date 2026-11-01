<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Pelaporan MBG</title>
</head>
<body style="font-family: sans-serif; padding: 2rem;">
    <h2>Login Aplikasi MBG</h2>
    @error('loginError')
        <p style="color: red;">[ {{ $message }} ]</p>
    @enderror

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <p>
            <label>Email</label><br>
            <input type="email" name="email" required>
        </p>
        <p>
            <label>Password</label><br>
            <input type="password" name="password" required>
        </p>
        <button type="submit">Masuk</button>
    </form>
</body>
</html>