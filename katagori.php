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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banime</title>
    <link rel="stylesheet" href="/katagori.css">
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
                    <form method="get" action="katagori.php">
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
            <div class="title">
                <p>Categories</p>
            </div>
            <div class="Highlights">

                <!-- start -->
                <?php
                include("koneksi.php");

                // Tentukan jumlah item per halaman
                $item_per_page = 20;

                // Ambil halaman saat ini
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                // Hitung offset untuk query SQL
                $offset = ($current_page - 1) * $item_per_page;

                // Tentukan kata kunci pencarian
                $search_keyword = isset($_GET['search']) ? $_GET['search'] : '';

                // Query SQL dengan LIMIT, OFFSET, dan kondisi pencarian
                $sql = "SELECT * FROM kategori WHERE kategori LIKE '%$search_keyword%' LIMIT $item_per_page OFFSET $offset";
                $result = $conn->query($sql);

                $no = 1;
                ?>

                <!-- start -->
                <?php if ($result->num_rows > 0) : ?>
                    <!-- Output data of each row -->
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <div class="content">
                            <div class="text">
                                <div class="Desc">
                                    <div class="card_title">
                                        <a href="kategoriAnime.php?id_kategori=<?php echo $row['id']; ?>"><?php echo $row["kategori"] ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
                <!-- End konten Loop -->

                <!-- Pagination Links -->

            </div>
            <div class="pagination">
                <?php
                // Hitung total halaman
                $total_pages = ceil($conn->query("SELECT COUNT(*) FROM kategori WHERE kategori LIKE '%$search_keyword%'")->fetch_row()[0] / $item_per_page);

                // Tampilkan tombol "Previous" jika bukan halaman pertama
                if ($current_page > 1) {
                    echo "<a href='?page=" . ($current_page - 1) . "&search=$search_keyword'>&laquo; Previous</a>";
                }

                // Tampilkan link pagination jika lebih dari satu halaman
                if ($total_pages > 1) {
                    // Tampilkan link pagination
                    for ($i = 1; $i <= $total_pages; $i++) {
                        $activeClass = ($i == $current_page) ? 'active' : '';
                        echo "<a href='?page=$i&search=$search_keyword' class='$activeClass'>$i</a>";
                    }

                    // Tampilkan tombol "Next" jika bukan halaman terakhir
                    if ($current_page < $total_pages) {
                        echo "<a href='?page=" . ($current_page + 1) . "&search=$search_keyword'>Next &raquo;</a>";
                    }
                }

                ?>
            </div>


            <!-- End konten Loop -->
            <?php $conn->close(); ?>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Banime. All rights reserved.</p>
    </footer>

    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="/Script.js"></script>

</body>

</html>