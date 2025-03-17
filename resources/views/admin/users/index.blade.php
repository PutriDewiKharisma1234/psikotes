<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <style>
        body {
            background-color: #FFF7DC;
            font-family: Arial, sans-serif;
        }

        h2 {
            text-align: center;
            color: #C2A883;
        }

        .container {
            width: 80%;
            margin: auto;
        }

        .btn-tambah {
            background-color: #C2A883;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 20px;
            display: inline-block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #D1B58D;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f1e7;
        }

        .btn-edit {
            background-color: #6A9B76;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .btn-hapus {
            background-color: #D07474;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Data Pengguna</h2>
        <a href="/admin/users/tambah" class="btn-tambah">+ Tambah Pengguna</a>

        <table border="1">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Peran</th>
                <th>Aksi</th>
            </tr>
            @foreach($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->peran }}</td>
                <td>
                    <a href="/admin/users/edit/{{ $user->id }}" class="btn-edit">Edit</a>
                    <form action="/admin/users/delete/{{ $user->id }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>

</html>
