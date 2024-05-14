<?php

// Set batas ukuran gambar
$maxWidth = 200;
$maxHeight = 200;

require 'koneksi.php';
session_start();

if (isset($_SESSION["id"])) {
    $sessionId = $_SESSION["id"];
    $query = "SELECT * FROM users WHERE id = $sessionId";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $user = mysqli_fetch_assoc($result);
    } else {
        // Handle query error
        echo "Error: " . mysqli_error($conn);
        exit();
    }
} else {
    // Handle session id not set
    echo "Session id not set";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banime</title>
    <link rel="stylesheet" href="css/Web.css?=v100">
    <link rel="icon" href="/Assets/BanimeLogo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <header>
        <div class="header"></div>
        <nav>
            <img src="/Assets/Banime.png" alt="Profile" id="Logo">
            <div class="list-menu" id="listMenu">
                <i class="ph ph-list"></i>
            </div>
        </nav>
    </header>

    <div class="container">
        <div class="wrapper">
            <div class="title">
                <p>Edit Profile</p>
            </div>
            <div class="Highlights">
                <form class="form" id="form" action="" enctype="multipart/form-data" method="post">
                    <div class="upload">
                        <?php
                        $id = $user["id"];
                        $username = $user["username"];
                        $profilepicture = $user["profilepicture"];
                        ?>
                        <img src="<?php echo $profilepicture ? 'PhotoProfile/' . $profilepicture : 'default_profile_image.jpg'; ?>" width="200" height="200" title="<?php echo $username; ?>">
                        <div class="round">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="username" value="<?php echo $username; ?>">
                            <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                            <i class="fa fa-camera" style="color: #fff;"></i>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Banime. All rights reserved.</p>
    </footer>

    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <script type="text/javascript">
        document.getElementById("image").onchange = function() {
            document.getElementById("form").submit();
        };
    </script>

    <?php

    if (isset($_FILES["image"])) { // Periksa apakah file diunggah
        $id = $_POST["id"];
        $username = $_POST["username"];

        $imageName = $_FILES["image"]["name"];
        $imageSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

        // Image validation
        $validImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION); // Perbaikan untuk mendapatkan ekstensi file
        if (!in_array($imageExtension, $validImageExtension)) {
            echo "
            <script>
            alert('Invalid Image Extension');
            document.location.href = 'ProfileController.php';
            </script>
            ";
            exit();
        } elseif ($imageSize > 1200000) {
            echo "
            <script>
            alert('Image Size Is Too Large');
            document.location.href = 'ProfileController.php';
            </script>
            ";
            exit();
        } else {
            // Proses gambar hanya jika validasi berhasil
            // Periksa apakah gambar melebihi batas ukuran yang ditetapkan
            $imageInfo = getimagesize($tmpName);
            $imageWidth = $imageInfo[0];
            $imageHeight = $imageInfo[1];

            // Periksa rasio aspek
            $aspectRatio = $imageWidth / $imageHeight;

            // Sesuaikan ukuran gambar jika diperlukan
            if ($imageWidth > $maxWidth || $imageHeight > $maxHeight) {
                if ($aspectRatio > 1) {
                    $newWidth = $maxWidth;
                    $newHeight = $maxWidth / $aspectRatio;
                } else {
                    $newWidth = $maxHeight * $aspectRatio;
                    $newHeight = $maxHeight;
                }

                // Crop gambar jika perlu
                if ($aspectRatio != 1) {
                    $cropWidth = min($imageWidth, $imageHeight);
                    $cropHeight = min($imageWidth, $imageHeight);
                    $sourceX = ($imageWidth - $cropWidth) / 2;
                    $sourceY = ($imageHeight - $cropHeight) / 2;
                    $source = imagecrop(imagecreatefromjpeg($tmpName), ['x' => $sourceX, 'y' => $sourceY, 'width' => $cropWidth, 'height' => $cropHeight]);
                    $imageWidth = $cropWidth;
                    $imageHeight = $cropHeight;
                } else {
                    $source = imagecreatefromjpeg($tmpName);
                }

                // Buat gambar baru dengan ukuran yang disesuaikan
                $newImage = imagecreatetruecolor($newWidth, $newHeight);
                imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newWidth, $newHeight, $imageWidth, $imageHeight);

                // Simpan gambar ke folder
                $newImageName = $username . " - " . date("Y.m.d") . " - " . date("h.i.sa") . '.' . $imageExtension;
                imagejpeg($newImage, 'PhotoProfile/' . $newImageName);

                // Hapus gambar sementara
                imagedestroy($newImage);
                if ($aspectRatio != 1) {
                    imagedestroy($source);
                }

                // Update database dengan nama gambar yang baru
                $query = "UPDATE users SET profilepicture = '$newImageName' WHERE id = $id";
                mysqli_query($conn, $query);
                echo "<script>window.location.href = 'ProfileController.php';</script>";
                exit();
            } else {
                // Proses gambar seperti sebelumnya jika tidak melebihi batas ukuran
                $newImageName = $username . " - " . date("Y.m.d") . " - " . date("h.i.sa") . '.' . $imageExtension;
                move_uploaded_file($tmpName, 'PhotoProfile/' . $newImageName);
                $query = "UPDATE users SET profilepicture = '$newImageName' WHERE id = $id";
                mysqli_query($conn, $query);
                echo "<script>window.location.href = 'ProfileController.php';</script>";
                exit();
            }
        }
    }

    ?>
</body>

</html>