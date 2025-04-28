<?php
session_start();
require 'koneksi.php';

$error = "";

// Data admin (sebaiknya disimpan di database dengan password di-hash)
$admin_credentials = [
    'email' => 'admin',
    'password' => 'admin123' // Dalam produksi, gunakan password yang di-hash
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Username dan Password harus diisi!";
    } else {
        // Cek login admin terlebih dahulu
        if ($username === $admin_credentials['email'] && $password === $admin_credentials['password']) {
            session_regenerate_id(true);
            $_SESSION['admin'] = true;
            $_SESSION['user'] = $admin_credentials['email'];
            header("Location: bas\index.html");
            exit();
        }
        
        // Jika bukan admin, lanjut ke proses user biasa
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            if (password_verify($password, $row['password'])) {
                session_regenerate_id(true);
                $_SESSION['user'] = $row['username'];
                header("Location: project.php");
                exit();
            } else {
                $error = "Password salah!";
            }
        } else {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $insert_query = "INSERT INTO users (username, password) VALUES (?, ?)";
            $insert_stmt = mysqli_prepare($conn, $insert_query);
            mysqli_stmt_bind_param($insert_stmt, "ss", $username, $hashed_password);
            
            if (mysqli_stmt_execute($insert_stmt)) {
                session_regenerate_id(true);
                $_SESSION['user'] = $username;
                header("Location: project.php");
                exit();
            } else {
                $error = "Gagal membuat akun baru. Coba lagi!";
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login dan Registrasi Otomatis</title>
    <style>
        body {
            background: #f0f2f5;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            width: 300px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login atau Registrasi</h2>
        <?php if ($error): ?>
            <p class="error-message"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
