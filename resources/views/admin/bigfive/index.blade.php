<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Soal Big Five</title>
    <style>
        body {
            background-color: #FFF7DC;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 90%;
            margin: auto;
        }

        h2 {
            text-align: center;
            color: #C2A883;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 12px 20px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #C2A883;
            color: white;
        }

        tr:hover {
            background-color: #f1e6d0;
        }

        .btn-edit {
            background-color: #4CAF50;
            color: white;
            padding: 5px 15px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-edit:hover {
            background-color: #45a049;
        }

        .btn-hapus {
            background-color: #E74C3C;
            color: white;
            padding: 5px 15px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            display: inline-block;
        }

        .btn-hapus:hover {
            background-color: #C0392B;
        }

        .aksi-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }

        .tambah-soal {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .btn-tambah {
            background-color: #B08A66;
            color: white;
            padding: 8px 20px;
            border: none;
            border-radius: 10px;
            text-decoration: none;
        }

        .btn-tambah:hover {
            background-color: #A0764B;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Manajemen Soal Big Five</h2>

        <div class="tambah-soal">
            <a href="/admin/bigfive/create" class="btn-tambah">Tambah Soal</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pertanyaan</th>
                    <th>Dimensi Big Five</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($soal as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->pertanyaan }}</td>
                    <td>{{ $item->dimensi }}</td>
                    <td>
                        <div class="aksi-buttons">
                            <a href="/admin/bigfive/edit/{{ $item->id }}" class="btn-edit">Edit</a>
                            <form action="/admin/bigfive/delete/{{ $item->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus soal ini?')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
