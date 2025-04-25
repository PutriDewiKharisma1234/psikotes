<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFF0BD;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .form-container {
            background-color: #ffffff;
            margin-top: 60px;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-container h2 {
            margin-bottom: 25px;
            color: #333;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #444;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #D5C7A3;
            border-radius: 8px;
            font-size: 14px;
            background-color: #FFFDF3;
        }

        button {
            background-color: #D5C7A3;
            color: white;
            padding: 12px 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #bba985;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Pengguna</h2>
        <form action="/admin/users/update/{{ $user->id }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" value="{{ $user->nama }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" required>
            </div>

            <div class="form-group">
                <label for="peran">Peran</label>
                <select id="peran" name="peran">
                    <option value="admin" {{ $user->peran == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="user" {{ $user->peran == 'user' ? 'selected' : '' }}>User</option>
                </select>
            </div>

            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
