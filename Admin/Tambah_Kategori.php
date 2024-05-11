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

    <script src="https://cdn.tiny.cloud/1/j1yiv9x82g9wptlzjslze7b78iaqf1ull21shtpy37np26fw/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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
                    <h1 class="h3 mb-2 text-gray-800">Kategori Konten Anime</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <a href="KategoriKontenAnime.php" class="m-0 font-weight-bold text-primary">Kembali</a>
                        </div>
                        <div class="card-body">

                            <form class="user" action="" method="post" enctype="multipart/form-data">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0"><label for="kategori">kategori</label>
                                        <input type="text" class="form-control" id="kategori" name="kategori" required>
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

</body>

</html>
<?php



if (isset($_POST["sv"])) {
    include("koneksi.php");

    $kategori = $_POST["kategori"];

    $sql = "INSERT INTO kategori (kategori) VALUES ('$kategori')";

    if ($conn->query($sql) === TRUE) {
        move_uploaded_file($tmp_file_baru, $path);
        echo "<script>alert('Data kategori berhasil disimpan');document.location='KategoriKontenAnime.php'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}


?>