<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banime</title>
    <link rel="stylesheet" href="/Web.css">
    <link rel="icon" href="/Assets/BanimeLogo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body>
    
    <?php
    include("header.php");
    ?>

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
                $sql = "SELECT * FROM konten_anime WHERE judul LIKE '%$search_keyword%' OR deskripsi LIKE '%$search_keyword%' LIMIT $item_per_page OFFSET $offset";
                $result = $conn->query($sql);

                $no = 1;
                ?>

                <!-- start -->
                <?php if ($result->num_rows > 0) : ?>
                    <!-- Output data of each row -->
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <div class="content">
                            <div class="image">
                            <a href="/detail_anime.php?idx=<?php echo $row['id']; ?>"><img src="/Admin/photos/<?php echo $row["gambar"] ?>" alt="Content_Picture"></a>
                            </div>
                            <div class="text">
                                <div class="Desc">
                                    <div class="card_title">
                                        <a href="/detail_anime.php?idx=<?php echo $row['id']; ?>"><?php echo $row["judul"] ?></a>
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
                $total_pages = ceil($conn->query("SELECT COUNT(*) FROM konten_anime WHERE judul LIKE '%$search_keyword%' OR deskripsi LIKE '%$search_keyword%'")->fetch_row()[0] / $item_per_page);

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
    <script src="Script.js"></script>
</body>

</html>