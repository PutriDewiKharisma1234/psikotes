<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
</head>
<body>
    <h2>Edit Pengguna</h2>
    <form action="/admin/users/update/{{ $user->id }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="nama" value="{{ $user->nama }}" required>
        <input type="email" name="email" value="{{ $user->email }}" required>
        <select name="peran">
            <option value="admin" {{ $user->peran == 'admin' ? 'selected' : '' }}>Admin</option>
            <option value="user" {{ $user->peran == 'user' ? 'selected' : '' }}>User</option>
        </select>
        <button type="submit">Simpan Perubahan</button>
    </form>
</body>
</html>
