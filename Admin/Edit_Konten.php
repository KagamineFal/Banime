<?php
session_start();
if (!isset($_SESSION["email"])) {
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

            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <meta name="author" content="">

            <title>Banime Admin</title>

            <!-- Custom fonts for this template -->
            <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
            <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

            <!-- Custom styles for this template -->
            <link href="css/sb-admin-2.min.css" rel="stylesheet">

            <!-- Custom styles for this page -->
            <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

            <script src="https://cdn.tiny.cloud/1/1f8mhev1qrynsazjp2sazeyjfotd6klab39nkjhoep1hw3o5/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
        </head>
        <!-- Place the first <script> tag in your HTML's <head> -->




        <body id="page-top">

            <!-- Page Wrapper -->
            <div id="wrapper">

                <?php
                include("sidebar.php");
                ?>

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">

                    <!-- Main Content -->
                    <div id="content">

                        <?php
                        include("topbar.php");
                        ?>

                        <!-- Begin Page Content -->
                        <div class="container-fluid">

                            <!-- Page Heading -->
                            <h1 class="h3 mb-2 text-gray-800">Konten Anime</h1>

                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <a href="Konten Anime.php" class="m-0 font-weight-bold text-primary">Kembali</a>
                                </div>
                                <div class="card-body">

                                    <form class="user" action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0"><label for="judul">Judul</label>
                                                <input type="text" class="form-control" id="judul" name="judul" value="<?php echo $row["judul"] ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0"><label for="desc">Deskripsi</label>
                                                <!-- <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea> -->
                                                <textarea name="desc"><?php echo $row["deskripsi"] ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0"><label for="isi">Isi Konten</label>
                                                <!-- <textarea class="form-control" id="desc" name="desc" rows="3" required></textarea> -->
                                                <textarea name="isi"><?php echo $row["deskripsi_dalem"] ?></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2 mb-3 mb-sm-0"><label for="tgl" class="form-label">Tanggal:</label>
                                                <input type="date" class="form-control" id="tgl" name="tgl" value="<?php echo $row["tgl"] ?>" required>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-2 mb-3 mb-sm-0"> <label for="upl" class="form-label">Upload:</label>
                                                <input type="file" class="form-control" id="upl" name="upl">
                                            </div>
                                            <div class="col-sm-2 mb-3 mb-sm-0"> <label for="upl" class="form-label">Gambar Saat Ini:</label>
                                                <img src="photos/<?php echo $row["gambar"] ?>" style="width: 300px;">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label for="kategori">Kategori</label><br>
                                                <?php
                                                // Mengambil data kategori dari database
                                                $sql_kategori = "SELECT * FROM kategori ORDER BY kategori ASC";
                                                $result_kategori = $conn->query($sql_kategori);

                                                // Mendapatkan kategori yang sudah terpilih pada data konten anime yang sedang diedit
                                                $sql_selected_kategori = "SELECT * FROM konten_anime WHERE id = $id";
                                                $result_selected_kategori = $conn->query($sql_selected_kategori);
                                                $selected_kategori_ids = array();

                                                while ($row_selected_kategori = $result_selected_kategori->fetch_assoc()) {
                                                    $selected_kategori_ids[] = $row_selected_kategori['id_kategori'];
                                                }

                                                // Menampilkan checkbox kategori
                                                while ($row_kategori = $result_kategori->fetch_assoc()) {
                                                    $kategori_id = $row_kategori['id'];
                                                    $kategori_nama = $row_kategori['kategori'];
                                                    $checked = in_array($kategori_id, $selected_kategori_ids) ? 'checked' : '';

                                                    echo "<input type='checkbox' name='kategori[]' value='$kategori_id' $checked> $kategori_nama<br>";
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">

                                                <br>
                                                <input type="submit" value="Submit" class="btn btn-primary" name="sv">
                                                <input type="reset" value="Reset" class="btn btn-warning">
                                            </div>
                                        </div>
                                    </form>



                                </div>
                            </div>

                        </div>
                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->

                    <?php
                    include("footer.php");
                    ?>

                </div>
                <!-- End of Content Wrapper -->

            </div>
            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/datatables/jquery.dataTables.min.js"></script>
            <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/datatables-demo.js"></script>

            <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
            <script>
                tinymce.init({
                    selector: 'textarea',
                    plugins: 'autolink lists link image charmap print preview',
                    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | link image',
                    tinycomments_mode: 'embedded',
                    tinycomments_author: 'Author name',
                    mergetags_list: [{
                            value: 'First.Name',
                            title: 'First Name'
                        },
                        {
                            value: 'Email',
                            title: 'Email'
                        },
                    ],
                    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
                });
            </script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        </body>

        </html>
<?php
    }
}
$conn->close();
?>
<?php


// if (isset($_POST["sv"])) {
//     include("koneksi.php");

//     $jdl = strip_tags($_POST["judul"]);
//     $des = $_POST["desc"];
//     $tgl = $_POST["tgl"];
//     $convertedDate = date("Y-m-d H:i:s", strtotime($tgl));

//     $nama_file = $_FILES['upl']['name'];
//     $tmp_file_baru = $_FILES['upl']['tmp_name'];

//     $waktu = date('Ymd_His');
//     $nama_file_baru = $waktu . $nama_file;
//     $path = "photos/" . $nama_file_baru;

//     if (!empty($nama_file)) {
//         $sql = "UPDATE konten_anime SET judul='$jdl', deskripsi='$des', tgl='$convertedDate', gambar='$nama_file_baru' WHERE id=$id;";
//     } else {
//         $sql = "UPDATE konten_anime SET judul='$jdl', deskripsi='$des', tgl='$convertedDate' WHERE id=$id;";
//     }

//     if ($conn->query($sql) === TRUE) {
//         move_uploaded_file($tmp_file_baru, $path);
//         echo "<script>alert('Data konten berhasil diubah');document.location='Konten Anime.php'</script>";
//     } else {
//         echo "Error: " . $sql . "<br>" . $conn->error;
//     }

//     $conn->close();
// }

if (isset($_POST["sv"])) {
    include("koneksi.php");

    $jdl = strip_tags($_POST["judul"]);
    $des = $_POST["desc"];
    $isi = $_POST["isi"];
    $tgl = $_POST["tgl"];
    $convertedDate = date("Y-m-d H:i:s", strtotime($tgl));

    // Check if categories are selected
    if (isset($_POST['kategori']) && is_array($_POST['kategori'])) {
        $selectedCategories = $_POST['kategori'];
        // You may want to sanitize the input before using it in the query
        $selectedCategories = array_map('intval', $selectedCategories);
        $categoryString = implode(',', $selectedCategories);
    } else {
        $categoryString = ''; // No categories selected
    }

    $nama_file = $_FILES['upl']['name'];
    $tmp_file_baru = $_FILES['upl']['tmp_name'];

    $waktu = date('Ymd_His');
    $nama_file_baru = $waktu . $nama_file;
    $path = "photos/" . $nama_file_baru;

    if (!empty($nama_file)) {
        $sql = "UPDATE konten_anime SET id_kategori='$categoryString' , judul='$jdl', deskripsi='$des', deskripsi_dalem='$isi', tgl='$convertedDate', gambar='$nama_file_baru' WHERE id=$id;";
    } else {
        $sql = "UPDATE konten_anime SET id_kategori='$categoryString' , judul='$jdl', deskripsi='$des', deskripsi_dalem='$isi', tgl='$convertedDate' WHERE id=$id;";
    }

    if ($conn->query($sql) === TRUE) {
        move_uploaded_file($tmp_file_baru, $path);
        echo "<script>alert('Data konten berhasil diubah');document.location='Konten Anime.php'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>