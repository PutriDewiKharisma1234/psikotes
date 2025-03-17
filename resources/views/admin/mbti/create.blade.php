<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Soal MBTI</title>
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
        <h2>Tambah Soal MBTI</h2>
        <form action="/admin/mbti/store" method="POST">
            @csrf
            <input type="text" name="pertanyaan" placeholder="Tulis Pertanyaan MBTI" required>

            <select name="dimensi" required>
                <option value="Ekstrovert vs Introvert">Ekstrovert vs Introvert</option>
                <option value="Sensing vs Intuition">Sensing vs Intuition</option>
                <option value="Thinking vs Feeling">Thinking vs Feeling</option>
                <option value="Judging vs Perceiving">Judging vs Perceiving</option>
            </select>

            <input type="text" name="pilihan_a" placeholder="Pilihan A (contoh: Ekstrovert)" required>
            <input type="text" name="pilihan_b" placeholder="Pilihan B (contoh: Introvert)" required>

            <button type="submit">Simpan Soal</button>
        </form>
    </div>
</body>

</html>
