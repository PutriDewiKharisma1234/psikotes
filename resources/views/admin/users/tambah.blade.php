<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
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

        /* Untuk bagian input password */
        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            right: 20px;
            top: 35%;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Tambah Pengguna</h2>
        <form action="/admin/users/store" method="POST">
            @csrf
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>

            <div class="password-wrapper">
                <input type="password" id="password" name="password" placeholder="Password" required>
                <span class="toggle-password" onclick="togglePassword()">🔒</span>
            </div>

            <select name="peran">
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            <button type="submit">Simpan</button>
        </form>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.toggle-password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.textContent = '🔓';
            } else {
                passwordInput.type = 'password';
                toggleIcon.textContent = '🔒';
            }
        }
    </script>

</body>

</html>
