<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Soal Big Five</title>
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
        <h2>Tambah Soal Big Five</h2>
        <form action="/admin/bigfive/store" method="POST">
            @csrf
            <input type="text" name="pertanyaan" placeholder="Tulis Pertanyaan Big Five" required>

            <select name="dimensi" required>
                <option value="Openness">Openness</option>
                <option value="Conscientiousness">Conscientiousness</option>
                <option value="Extraversion">Extraversion</option>
                <option value="Agreeableness">Agreeableness</option>
                <option value="Neuroticism">Neuroticism</option>
            </select>

            <input type="text" name="pilihan_a" value="Setuju" readonly>
            <input type="text" name="pilihan_b" value="Tidak Setuju" readonly>

            <button type="submit">Simpan Soal</button>
        </form>
    </div>
</body>

</html>
