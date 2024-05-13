<?php
if(isset($_SESSION['username_or_email'])) {
    // Jika sudah login, tampilkan tampilan untuk pengguna yang sudah login
    include("loginheader.php"); // Ganti dengan header untuk pengguna yang sudah login
} else {
    // Jika belum login, tampilkan tampilan default
    include("header.php"); // Gunakan header default
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
            <link rel="stylesheet" href="/css/detail.css">
            <link rel="icon" href="/Assets/BanimeLogo.png">
        </head>

        <body>

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