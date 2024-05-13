<?= $this->extend('Layout.php') ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="/Web.css">
<?= $this->endSection() ?>

<?= $this->section('header') ?>
<p>Highlights</p>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- start -->
<?php
include ("koneksi.php");

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
<?php if ($result->num_rows > 0): ?>
    <!-- Output data of each row -->
    <?php while ($row = $result->fetch_assoc()): ?>
        <div class="content">
            <div class="image">
                <a href="/detail_anime.php?idx=<?php echo $row['id']; ?>"><img src="/Admin/photos/<?php echo $row["gambar"] ?>"
                        alt="Content_Picture"></a>
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
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="Script.js"></script>
<?= $this->endSection() ?>