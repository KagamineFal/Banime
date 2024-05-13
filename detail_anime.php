<?php
session_start();
if (!isset($_SESSION["$username_or_email"])) {
    // Redirect ke halaman login jika belum login
    header("Location: login.php");
    exit();
}

// Tampilkan halaman dashboard
// echo "Selamat datang, " . $_SESSION["email"] . "! Ini adalah halaman dashboard.";
?>

<?php
include("koneksi.php");
$id = $_GET['idx'];
$sql = "SELECT * FROM konten_anime WHERE id = $id";
$result = $conn->query($sql);
$no = 1;

if ($result->num_rows > 0) {
    //output data of each row
    while ($row = $result->fetch_assoc()) {
        $tanggal_dari_database = $row["tgl"];

        // Mengubah format tanggal
        $tanggal_format_baru = date("j F Y", strtotime($tanggal_dari_database));

?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Banime</title>
            <link rel="stylesheet" href="/detail.css">
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
                            <a href="/about.php"> ABOUT US</a>
                        </div>
                        <div class="Search">
                            <input class="input hidden" type="text" id="input" placeholder="Search">
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
                    <div class="title">
                        <p><?php echo $row["judul"] ?></p>
                    </div>
                    <div class="detail">
                        <a><?php echo $tanggal_format_baru ?></a>
                        <h2>By Fall</h2>
                    </div>
                    <div class="image">
                        <img src="/Admin/photos/<?php echo $row["gambar"] ?>">
                    </div>
                </div>
                <div class="text">
                    <?= $row["deskripsi_dalem"] ?>
                </div>
            </div>

            <script src="https://unpkg.com/@phosphor-icons/web"></script>
            <script src="/Script.js"></script>

            <footer>
                <p>&copy; 2023 Banime. All rights reserved.</p>
            </footer>

        </body>

        </html>
<?php
    }
}
$conn->close();
?>