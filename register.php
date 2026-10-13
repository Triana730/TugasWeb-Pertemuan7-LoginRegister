<?php

require_once 'functions.php';

$errors = [];
$success = "";

$nama = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Sanitasi input
    $nama = htmlspecialchars(trim($_POST["nama"] ?? ""));
    $email = htmlspecialchars(trim($_POST["email"] ?? ""));
    $password = $_POST["password"] ?? "";

    // Validasi nama
    if (empty($nama)) {
        $errors[] = "Nama wajib diisi.";
    } elseif (strlen($nama) < 3) {
        $errors[] = "Nama minimal 3 karakter.";
    }

    // Validasi email
    if (empty($email)) {
        $errors[] = "Email wajib diisi.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Format email tidak valid.";
    }

    // Validasi password
    if (empty($password)) {
        $errors[] = "Password wajib diisi.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password minimal 6 karakter.";
    }

    // Jika tidak ada error
    if (empty($errors)) {

        // Ambil data user dari JSON
        $users = getUsers();

        // Cek apakah email sudah terdaftar
        $emailExists = false;

        foreach ($users as $user) {
            if (strtolower($user["email"]) === strtolower($email)) {
                $emailExists = true;
                break;
            }
        }

        if ($emailExists) {

            $errors[] = "Email sudah terdaftar. Silakan gunakan email lain.";

        } else {

            // Membuat ID user
            $id = count($users) + 1;

            // Hash password
            $hashedPassword = password_hash(
                $password,
                PASSWORD_DEFAULT
            );

            // Data user baru
            $newUser = [
                "id" => $id,
                "nama" => $nama,
                "email" => $email,
                "password" => $hashedPassword
            ];

            // Tambahkan user
            $users[] = $newUser;

            // Simpan ke JSON
            if (saveUsers($users)) {

                $success = "Registrasi berhasil! Silakan login.";

                // Kosongkan form
                $nama = "";
                $email = "";

            } else {

                $errors[] = "Terjadi kesalahan saat menyimpan data.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Tugas Rutin 7</title>

    <link rel="stylesheet" href="assets/style.css">

</head>

<body>

    <div class="auth-container">

        <div class="auth-card">

            <div class="auth-header">

                <h1>✨ Buat Akun</h1>

                <p>
                    Daftar untuk membuat akun baru
                </p>

            </div>


            <?php if (!empty($errors)): ?>

                <div class="alert error">

                    <strong>Terjadi kesalahan:</strong>

                    <ul>

                        <?php foreach ($errors as $error): ?>

                            <li>
                                <?= htmlspecialchars($error) ?>
                            </li>

                        <?php endforeach; ?>

                    </ul>

                </div>

            <?php endif; ?>


            <?php if (!empty($success)): ?>

                <div class="alert success">

                    <?= htmlspecialchars($success) ?>

                    <br><br>

                    <a href="login.php">
                        Login sekarang →
                    </a>

                </div>

            <?php endif; ?>


            <form method="POST" action="">

                <div class="form-group">

                    <label for="nama">
                        Nama Lengkap
                    </label>

                    <input
                        type="text"
                        id="nama"
                        name="nama"
                        placeholder="Masukkan nama lengkap"
                        value="<?= htmlspecialchars($nama) ?>"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="email">
                        Email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="contoh@email.com"
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
                        placeholder="Minimal 6 karakter"
                        required
                    >

                </div>


                <button type="submit" class="btn-primary">

                    Daftar

                </button>

            </form>


            <div class="auth-footer">

                <p>
                    Sudah punya akun?
                    <a href="login.php">
                        Login di sini
                    </a>
                </p>

            </div>

        </div>

    </div>

</body>

</html>