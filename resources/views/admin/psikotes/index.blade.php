<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Psikotes</title>
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
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
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

        .aksi-buttons {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .btn-detail {
            background-color: #3498DB;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.2s ease;
        }

        .btn-detail:hover {
            background-color: #2980B9;
        }

        .btn-edit {
            background-color: #2ECC71;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.2s ease;
        }

        .btn-edit:hover {
            background-color: #27AE60;
        }

        .btn-hapus {
            background-color: #E74C3C;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        .btn-hapus:hover {
            background-color: #C0392B;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Data Psikotes</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pengguna</th>
                    <th>Jenis Tes</th>
                    <th>Hasil</th>
                    <th>Tanggal Tes</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hasil as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->user->nama }}</td>
                    <td>{{ $item->jenis_tes }}</td>
                    <td>{{ $item->hasil }}</td>
                    <td>{{ $item->created_at->format('d M Y') }}</td>
                    <td>
                        <div class="aksi-buttons">
                            <a href="{{ route('admin.psikotes.detail', $item->id) }}" class="btn-detail">Lihat Detail</a>
                            <a href="{{ route('admin.psikotes.edit', $item->id) }}" class="btn-edit">Edit</a>
                            <form action="/admin/psikotes/delete/{{ $item->id }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-hapus">Hapus</button>
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
