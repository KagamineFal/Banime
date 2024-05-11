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

</head>

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
                            <a href="Tambah_Kategori.php" class="m-0 font-weight-bold text-primary">Tambah Kategori</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kategori</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include("koneksi.php");
                                        $sql = "SELECT * FROM kategori";
                                        $result = $conn->query($sql);
                                        $no = 1;

                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                        ?>
                                                <tr>
                                                    <td><?php echo $no++ ?></td>
                                                    <td><?php echo $row["kategori"] ?></td>
                                                    <td>
                                                        <a href="Edit_Kategori.php?idx=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                                                        <a href="#" class="btn btn-danger" onclick="deleteItem(<?php echo $row['id']; ?>);">Hapus</a>
                                                    </td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        $conn->close();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
    <!-- Include SweetAlert library -->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function deleteItem(kategoriId) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Apakah Anda yakin?",
                text: "Anda tidak akan dapat mengembalikannya!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi, lakukan penghapusan menggunakan Ajax
                    $.ajax({
                        type: "POST",
                        url: "delete_kategori.php",
                        data: {
                            idx: kategoriId
                        },
                        success: function(response) {
                            // Tampilkan pesan dari server jika diperlukan
                            console.log(response);
                            // Tampilkan SweetAlert setelah penghapusan berhasil
                            swalWithBootstrapButtons.fire({
                                title: "Dihapus!",
                                text: "Kategori berhasil dihapus.",
                                icon: "success"
                            }).then(function() {
                                // Lakukan sesuatu setelah SweetAlert ditutup jika diperlukan
                                // Contoh: refresh halaman
                                location.reload();
                            });
                        },
                        error: function(error) {
                            console.error("Error:", error);
                            // Tampilkan SweetAlert untuk pesan error jika diperlukan
                            swalWithBootstrapButtons.fire({
                                title: "Error",
                                text: "Terjadi kesalahan saat menghapus kategori.",
                                icon: "error"
                            });
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    // Pengguna membatalkan, tampilkan pesan SweetAlert
                    swalWithBootstrapButtons.fire({
                        title: "Dibatalkan",
                        text: "Kategori Anda tetap aman :)",
                        icon: "error"
                    });
                }
            });
        }
    </script>


</body>

</html>