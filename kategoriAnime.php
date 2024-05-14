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
    <link rel="stylesheet" href="/css/Web.css">
    <link rel="icon" href="/Assets/BanimeLogo.png">
</head>

<body>

    <div class="container">
        <div class="wrapper">
            <div class="title">
                <p>Highlights</p>
            </div>
            <div class="Highlights">

                <!-- start -->
                <?php
                include("koneksi.php");

                // Tentukan jumlah item per halaman
                $item_per_page = 9;

                // Ambil halaman saat ini
                $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                // Hitung offset untuk query SQL
                $offset = ($current_page - 1) * $item_per_page;

                // Tentukan kata kunci pencarian
                $search_keyword = isset($_GET['search']) ? $_GET['search'] : '';

                // Query SQL dengan LIMIT, OFFSET, dan kondisi pencarian
                $id_kategori = isset($_GET['id_kategori']) ? $_GET['id_kategori'] : '';

                // Use $id_kategori in your SQL query to fetch content related to the specified id_kategori
                $sql = "SELECT * FROM konten_anime WHERE id_kategori LIKE '%$id_kategori%'";

                // $sql = "SELECT * FROM Konten_Anime WHERE judul LIKE '%$search_keyword%' OR deskripsi LIKE '%$search_keyword%' LIMIT $item_per_page OFFSET $offset";
                $result = $conn->query($sql);

                $no = 1;
                ?>

                <!-- start -->
                <?php if ($result->num_rows > 0) : ?>
                    <!-- Output data of each row -->
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <div class="content">
                            <div class="image">
                                <a href="Anime/Maou Gakuin No Futekigousha Musim Kedua Akan Lanjut 2024/index.html"><img src="/Admin/photos/<?php echo $row["gambar"] ?>" alt="Maou Gakuin No Futekigousha"></a>
                            </div>
                            <div class="text">
                                <div class="Desc">
                                    <div class="card_title">
                                        <a href="detail_anime.php?idx=<?php echo $row['id']; ?>"><?php echo $row["judul"] ?></a>
                                    </div>
                                    <?php echo $row['deskripsi']; ?>
                                </div>
                                <div class="Date">
                                    <p><?php echo $row["tgl"] ?></p>
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
                $total_pages = ceil($conn->query("SELECT COUNT(*) FROM Konten_Anime WHERE judul LIKE '%$search_keyword%' OR deskripsi LIKE '%$search_keyword%'")->fetch_row()[0] / $item_per_page);

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
        <p>&copy; 2023 Your Website. All rights reserved.</p>
    </footer>

    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script src="/Script.js"></script>

</body>

</html>