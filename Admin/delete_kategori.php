<?php
// Include file koneksi.php
include("koneksi.php");

// Periksa apakah parameter idx telah diterima dari permintaan POST
if (isset($_POST["idx"])) {
    // Dapatkan nilai idx dari permintaan POST
    $kategoriId = $_POST["idx"];

    // Lakukan kueri DELETE untuk menghapus kategori berdasarkan id
    $sqlDelete = "DELETE FROM kategori WHERE id = $kategoriId";

    if ($conn->query($sqlDelete) === TRUE) {
        // Jika penghapusan berhasil, kirim respons sukses
        echo "Kategori berhasil dihapus";
    } else {
        // Jika terjadi kesalahan, kirim respons kesalahan
        echo "Error: " . $sqlDelete . "<br>" . $conn->error;
    }
} else {
    // Jika parameter idx tidak diterima, kirim respons kesalahan
    echo "Invalid request";
}

// Tutup koneksi database
$conn->close();
?>
