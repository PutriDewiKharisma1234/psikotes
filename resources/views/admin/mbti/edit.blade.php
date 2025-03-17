<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Soal MBTI</title>
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
        <h2>Edit Soal MBTI</h2>
        <form action="/admin/mbti/update/{{ $soal->id }}" method="POST">
            @csrf
            @method('PUT')

            <input type="text" name="pertanyaan" value="{{ $soal->pertanyaan }}" required>

            <select name="dimensi" required>
                @foreach ($dimensi as $item)
                    <option value="{{ $item }}" {{ $soal->dimensi == $item ? 'selected' : '' }}>
                        {{ $item }}
                    </option>
                @endforeach
            </select>

            <input type="text" name="pilihan_a" value="{{ $soal->pilihan_a }}" required>
            <input type="text" name="pilihan_b" value="{{ $soal->pilihan_b }}" required>

            <button type="submit">Update Soal</button>
        </form>

    </div>
</body>

</html>
