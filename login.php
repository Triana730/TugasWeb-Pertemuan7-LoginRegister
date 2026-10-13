<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once 'functions.php';

$error = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"] ?? "");
    $password = $_POST["password"] ?? "";

    // Validasi email
    if ($email === "") {

        $error = "Email wajib diisi.";

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = "Format email tidak valid.";

    } elseif ($password === "") {

        $error = "Password wajib diisi.";

    } else {

        // Ambil data user
        $users = getUsers();

        $userFound = false;

        foreach ($users as $user) {

            if (strtolower($user["email"]) === strtolower($email)) {

                $userFound = true;

                // Cek password
                if (password_verify($password, $user["password"])) {

                    $_SESSION["user_id"] = $user["id"];
                    $_SESSION["nama"] = $user["nama"];
                    $_SESSION["email"] = $user["email"];

                    header("Location: dashboard.php");
                    exit;

                } else {

                    $error = "Password yang dimasukkan salah.";
                }

                break;
            }
        }

        if (!$userFound) {

            $error = "Email belum terdaftar.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Tugas Rutin 7</title>

    <link rel="stylesheet" href="assets/style.css">

</head>

<body>

    <div class="auth-container">

        <div class="auth-card">

            <div class="auth-header">

                <h1>🔐 Login</h1>

                <p>Masuk ke akun yang sudah terdaftar</p>

            </div>


            <?php if ($error !== ""): ?>

                <div class="alert error">

                    <?= htmlspecialchars($error) ?>

                </div>

            <?php endif; ?>


            <form method="POST">

                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Masukkan email"
                        value="<?= htmlspecialchars($email) ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="password">
                        Password
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        required
                    >

                </div>


                <button
                    type="submit"
                    class="btn-primary"
                >
                    Login
                </button>

            </form>


            <div class="auth-footer">

                <p>
                    Belum punya akun?

                    <a href="register.php">
                        Daftar di sini
                    </a>
                </p>

            </div>

        </div>

    </div>

</body>

</html>
