<?php

session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Cek apakah user sudah login
if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$nama = $_SESSION["nama"] ?? "User";
$email = $_SESSION["email"] ?? "-";

?>

<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Tugas Rutin 7</title>

    <link rel="stylesheet" href="assets/style.css">

</head>

<body>

    <div class="dashboard-container">

        <div class="dashboard-card">

            <div class="dashboard-icon">
                👋
            </div>

            <h1>Selamat Datang!</h1>

            <p class="welcome-text">
                Halo,
                <strong><?= htmlspecialchars($nama) ?></strong>!
            </p>

            <div class="user-info">

                <div class="info-item">

                    <div>
                        <span>Nama Lengkap</span>
                        <strong>
                            <?= htmlspecialchars($nama) ?>
                        </strong>
                    </div>

                    <div class="info-icon">
                        👤
                    </div>

                </div>


                <div class="info-item">

                    <div>
                        <span>Email</span>
                        <strong>
                            <?= htmlspecialchars($email) ?>
                        </strong>
                    </div>

                    <div class="info-icon">
                        ✉️
                    </div>

                </div>

            </div>

            <div class="status-box">

                <span class="status-dot"></span>

                <span>
                    Anda berhasil login ke dalam sistem.
                </span>

            </div>


            <a href="logout.php" class="btn-logout">
                Logout
            </a>

        </div>

    </div>

</body>

</html>