<?php
include("koneksi.php");

if (isset($_POST['idx'])) {
    $itemId = $_POST['idx'];

    // Tambahkan logika penghapusan dari database sesuai dengan kebutuhan Anda
    $sql = "DELETE FROM konten_anime WHERE id = $itemId";
    if ($conn->query($sql) === TRUE) {
        echo "File deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
