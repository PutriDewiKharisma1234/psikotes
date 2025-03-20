<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Big Five</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFF7DC;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: auto;
            text-align: center;
            padding: 20px;
        }

        h2 {
            color: #C2A883;
        }

        .soal {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
            text-align: left;
        }

        .soal p {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .jawaban {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 10px;
        }

        .jawaban label {
            background-color: #f4e1c8;
            padding: 12px;
            border-radius: 8px;
            width: 150px;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        .jawaban label:hover {
            background-color: #e3c7a6;
        }

        .jawaban input {
            display: none;
        }

        .jawaban input:checked + label {
            background-color: #C2A883;
            color: white;
            font-weight: bold;
        }

        .btn-submit {
            background-color: #C2A883;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 18px;
            margin-top: 20px;
            transition: background 0.3s ease-in-out;
        }

        .btn-submit:hover {
            background-color: #A0764B;
        }

        .alert {
            color: red;
            font-weight: bold;
            display: none;
            margin-bottom: 15px;
        }

        @media (max-width: 768px) {
            .container {
                width: 95%;
            }

            .jawaban {
                flex-direction: row;
                flex-wrap: wrap;
                gap: 10px;
            }

            .jawaban label {
                width: 45%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Tes Big Five</h2>
        <p>Silakan pilih jawaban yang sesuai dengan kepribadian Anda.</p>

        <div class="alert" id="error-message">Harap jawab semua pertanyaan sebelum mengirim!</div>

        <form id="tesBigFiveForm" action="{{ route('tes.bigfive.proses') }}" method="POST">
            @csrf

            @foreach ($soal as $item)
                <div class="soal" id="soal-{{ $item->id }}">
                    <p>{{ $item->pertanyaan }}</p>
                    <div class="jawaban">
                        <input type="radio" id="setuju{{ $item->id }}" name="jawaban[{{ $item->id }}]" value="Setuju">
                        <label for="setuju{{ $item->id }}">Setuju</label>

                        <input type="radio" id="tidak_setuju{{ $item->id }}" name="jawaban[{{ $item->id }}]" value="Tidak Setuju">
                        <label for="tidak_setuju{{ $item->id }}">Tidak Setuju</label>
                    </div>
                </div>
            @endforeach

            <button type="submit" class="btn-submit" onclick="return validateForm()">Selesai Tes</button>
        </form>
    </div>

    <script>
        function validateForm() {
            let isValid = true;
            let errorMessage = document.getElementById("error-message");
            errorMessage.style.display = "none"; // Sembunyikan pesan error awalnya

            document.querySelectorAll(".soal").forEach(soal => {
                let radios = soal.querySelectorAll("input[type=radio]");
                let checked = Array.from(radios).some(radio => radio.checked);

                if (!checked) {
                    isValid = false;
                    soal.style.border = "2px solid red"; // Tandai soal yang belum dijawab
                    soal.scrollIntoView({ behavior: "smooth", block: "center" }); // Scroll ke soal pertama yang belum dijawab
                    return false; // Hentikan loop setelah menemukan pertanyaan yang belum dijawab
                } else {
                    soal.style.border = "none"; // Hapus tanda merah jika sudah dijawab
                }
            });

            if (!isValid) {
                errorMessage.style.display = "block"; // Tampilkan pesan error
            }

            return isValid;
        }
    </script>

</body>
</html>
