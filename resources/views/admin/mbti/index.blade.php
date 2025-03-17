<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Soal MBTI</title>
    <style>
        body {
            background-color: #FFF7DC;
            font-family: Arial, sans-serif;
        }

        table {
            width: 90%;
            margin: auto;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px 20px;
            text-align: center;
            border: 1px solid #ccc;
        }

        th {
            background-color: #C2A883;
            color: white;
        }

        .btn-edit {
            background-color: #4CAF50;
            color: white;
            padding: 5px 15px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
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
        }

        .btn-hapus:hover {
            background-color: #C0392B;
        }

        .tambah-soal {
            display: flex;
            justify-content: flex-end;
            margin-right: 5%;
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
    <h2 style="text-align: center; color: #C2A883;">Manajemen Soal MBTI</h2>

    <div class="tambah-soal">
        <a href="/admin/mbti/create" class="btn-tambah">Tambah Soal</a>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pertanyaan</th>
                <th>Tipe Soal</th>
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
                    <a href="/admin/mbti/edit/{{ $item->id }}" class="btn-edit">Edit</a>
                    <form action="/admin/mbti/delete/{{ $item->id }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus soal ini?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
