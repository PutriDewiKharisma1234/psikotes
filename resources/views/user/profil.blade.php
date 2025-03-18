<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFF7DC;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            color: #C2A883;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #C2A883;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background-color: #A0764B;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 40px;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Edit Profil</h2>
        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <form action="/user/profil/update" method="POST">
            @csrf
            <input type="text" name="nama" value="{{ $user->nama }}" required>
            <input type="email" name="email" value="{{ $user->email }}" required>

            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Kata Sandi Baru (Opsional)">
                <span class="toggle-password" onclick="togglePassword('password')">🔒</span>
            </div>

            <div class="password-wrapper">
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Kata Sandi">
                <span class="toggle-password" onclick="togglePassword('password_confirmation')">🔒</span>
            </div>

            <button type="submit">Simpan Perubahan</button>
        </form>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            field.type = field.type === "password" ? "text" : "password";
        }
    </script>

</body>
</html>
