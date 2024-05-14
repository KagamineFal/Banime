<?php
// Index.php
session_start();

if(isset($_SESSION['id'])) {
    // Jika sudah login, tampilkan tampilan untuk pengguna yang sudah login
    include("Header/loginheader.php"); // Ganti dengan header untuk pengguna yang sudah login
} else {
    // Jika belum login, tampilkan tampilan default
    include("Header/header.php"); // Gunakan header default
}

// Tampilkan halaman dashboard
// echo "Selamat datang, " . $_SESSION["email"] . "! Ini adalah halaman dashboard.";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banime</title>
    <link rel="stylesheet" href="/css/about.css">
    <link rel="icon" href="/Assets/BanimeLogo.png">
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="Desc">
                <a>About Us</a>
                <p>Selamat datang di Banime - Sumber Berita Anime Terpercaya!</p>
                <div class="content">
                    <p>
                        Banime adalah situs berita anime yang didedikasikan untuk memberikan informasi terbaru, ulasan
                        mendalam, dan liputan eksklusif seputar dunia anime. Kami percaya bahwa anime bukan hanya
                        hiburan,
                        tetapi juga bentuk seni yang dapat mempengaruhi dan menginspirasi. Dengan semangat ini, kami
                        berusaha menjadi destinasi utama bagi para penggemar anime yang haus akan wawasan dan kabar
                        terkini.
                    </p>
                </div>
            </div>
            <img src="/Assets/Website_About_us.png" alt="Picture">
        </div>
    </div>
    </div>

    <footer>
        <p>&copy; 2023 Banime. All rights reserved.</p>
    </footer>

    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="Script.js"></script>

</body>

</html>