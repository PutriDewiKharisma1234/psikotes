<!DOCTYPE html>
<html lang="id">
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Selamat Datang, {{ Auth::user()->nama }}</h1>
    <a href="/keluar">Keluar</a>
</body>
</html>
