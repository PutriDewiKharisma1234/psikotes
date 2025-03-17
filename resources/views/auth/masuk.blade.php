<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Psikotes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFF0BD;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 40px 50px;
            border-radius: 15px;
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #B17F59;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #D5C7A3;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #D5C7A3;
        }

        a {
            display: block;
            margin-top: 15px;
            color: #333;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            width: 100%;
            padding-right: 40px;
        }

        .toggle-password {
            position: absolute;
            right: 10px;
            top: 35%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #777;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Masuk Akun</h1>
        <form action="/proses-masuk" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Kata Sandi" required>
                <span class="toggle-password" onclick="togglePassword('password')">🔒</span>
            </div>
            <button type="submit">Masuk</button>
            <a href="/daftar">Belum punya akun? Daftar di sini</a>
        </form>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            if (field.type === "password") {
                field.type = "text";
            } else {
                field.type = "password";
            }
        }
    </script>
</body>
</html>
