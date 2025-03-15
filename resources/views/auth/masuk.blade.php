<!DOCTYPE html>
<html lang="id">
<head>
    <title>Halaman Login</title>
</head>
<body>
    <h1>Masuk Akun</h1>
    <form action="/proses-masuk" method="POST">
        @csrf
        <input type="email" name="email" placeholder="Email"><br>
        <input type="password" name="kata_sandi" placeholder="Kata Sandi"><br>
        <button type="submit">Masuk</button>
    </form>
    <a href="/daftar">Belum punya akun? Daftar di sini!</a>
</body>
</html>
