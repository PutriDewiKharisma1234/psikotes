<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
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
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .password-wrapper {
            position: relative;
            width: 100%;
        }

        .password-wrapper input {
            width: 100%;
            padding: 10px 40px 10px 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 35%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #555;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #BDB395;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #9E8F6E;
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

    </style>
</head>
<body>
    <div class="container">
        <h1>Login Admin</h1>
        <form action="/admin/proses-login" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Email Admin" required>

            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Kata Sandi" required>
                <span class="toggle-password" onclick="togglePassword()">🔒</span>
            </div>

            <button type="submit">Masuk</button>
        </form>
    </div>

   <script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.querySelector('.toggle-password');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.textContent = '🔓'; // Ikon kunci terbuka
        } else {
            passwordInput.type = 'password';
            toggleIcon.textContent = '🔒'; // Ikon kunci terkunci
        }
    }
    </script>

    
</body>
</html>
