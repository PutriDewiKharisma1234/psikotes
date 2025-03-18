<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Soal Big Five</title>
    <style>
        body {
            background-color: #FFF7DC;
            font-family: Arial, sans-serif;
        }

        .container {
            width: 50%;
            margin: auto;
        }

        h2 {
            text-align: center;
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
        }

        button:hover {
            background-color: #B08A66;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Soal Big Five</h2>
        <form action="/admin/bigfive/update/{{ $soal->id }}" method="POST">
            @csrf
            @method('PUT')
            <input type="text" name="pertanyaan" value="{{ $soal->pertanyaan }}" required>

            <select name="dimensi" required>
                <option value="Openness" {{ $soal->dimensi == 'Openness' ? 'selected' : '' }}>Openness</option>
                <option value="Conscientiousness" {{ $soal->dimensi == 'Conscientiousness' ? 'selected' : '' }}>Conscientiousness</option>
                <option value="Extraversion" {{ $soal->dimensi == 'Extraversion' ? 'selected' : '' }}>Extraversion</option>
                <option value="Agreeableness" {{ $soal->dimensi == 'Agreeableness' ? 'selected' : '' }}>Agreeableness</option>
                <option value="Neuroticism" {{ $soal->dimensi == 'Neuroticism' ? 'selected' : '' }}>Neuroticism</option>
            </select>

            <input type="text" name="pilihan_a" value="Setuju" readonly>
            <input type="text" name="pilihan_b" value="Tidak Setuju" readonly>

            <button type="submit">Simpan Perubahan</button>
        </form>
        <a href="/admin/bigfive">Kembali ke daftar soal</a>
    </div>
</body>

</html>
