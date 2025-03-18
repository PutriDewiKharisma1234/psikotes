<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Hasil Tes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFF7DC;
            text-align: center;
            padding: 20px;
        }
        .container {
            width: 50%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #C2A883;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
        button {
            background-color: #C2A883;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #A0764B;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Hasil Tes</h2>
        <form action="{{ route('admin.psikotes.update', $hasil->id) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="hasil">Hasil Tes:</label>
            <input type="text" id="hasil" name="hasil" value="{{ $hasil->hasil }}" required>

            <button type="submit">Simpan Perubahan</button>
        </form>
        <a href="/admin/psikotes">Kembali</a>
    </div>
</body>
</html>
