<!DOCTYPE html>
<html lang="id">
<head>
    <title>Registrasi Pengguna</title>
</head>
<body>
    <h1>Halaman Registrasi</h1>
    <form action="/proses-daftar" method="POST">
        @csrf
        <input type="text" name="nama" placeholder="Nama Lengkap"><br>
        <input type="email" name="email" placeholder="Email"><br>
        <input type="password" name="kata_sandi" placeholder="Kata Sandi"><br>
        <input type="password" name="kata_sandi_confirmation" placeholder="Konfirmasi Kata Sandi"><br>
        <button type="submit">Daftar</button>
    </form>
    <a href="/masuk">Sudah punya akun? Masuk disini!</a>
</body>
</html>
