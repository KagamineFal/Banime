<?php
session_start();
if (!isset($_SESSION["username_or_email"])) {
    // Redirect ke halaman login jika belum login
    header("Location: login.php");
    exit();
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
    <link rel="stylesheet" href="about.css">
    <link rel="icon" href="/Assets/BanimeLogo.png">
</head>

<body>
    <header>
        <div class="header"></div>
        <nav>
            <img src="/Assets/Banime.png" alt="Profile" id="Logo">
            <div class="list-menu" id="listMenu">
                <i class="ph ph-list"></i>
            </div>

            <div class="navall navHidden" id="navList">
                <div class="Nav">
                    <a href="/"> HOME</a>
                    <a href="/katagori.php"> CATEGORIES</a>
                    <a href="/"> ABOUT US</a>
                </div>
                <div class="Search">
                    <form method="get" action="index.php">
                        <input class="input hidden" type="text" name="search" id="input" placeholder="Search">
                    </form>
                    <i class="ph ph-magnifying-glass" id="search"></i>
                </div>
            </div>

            <div class="Login">
                <i class="ph ph-user-circle" onclick="toggleMenu()"></i>
            </div>

            <div class="sub-menu-warp" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <i class="ph ph-user-circle"></i>
                        <h2>Profile</h2>
                    </div>
                    <hr>

                    <a href="/Admin/login.php" class="sub-menu-link">
                        <i class="ph ph-key"></i>
                        <p>Admin Area</p>
                        <span>❯</span>
                    </a>
                </div>
            </div>
        </nav>
    </header>

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