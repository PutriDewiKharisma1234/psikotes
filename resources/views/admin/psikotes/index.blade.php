<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Psikotes</title>
    <style>
        body { background-color: #FFF7DC; font-family: Arial, sans-serif; }
        .container { width: 90%; margin: auto; }
        h2 { text-align: center; color: #C2A883; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; }
        th, td { padding: 12px 15px; text-align: center; border-bottom: 1px solid #ddd; }
        th { background-color: #C2A883; color: white; }
        tr:hover { background-color: #f1e6d0; }
        .btn-hapus { background-color: #E74C3C; color: white; padding: 5px 10px; border: none; cursor: pointer; }
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
                        <a href="{{ route('admin.psikotes.detail', $item->id) }}" class="btn-edit">Lihat Detail</a>
                        <a href="{{ route('admin.psikotes.edit', $item->id) }}" class="btn-edit">Edit</a>
                        <form action="/admin/psikotes/delete/{{ $item->id }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-hapus" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
