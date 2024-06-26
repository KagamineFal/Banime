<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Banime Admin Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form method="post" action="">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." name="email">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="pass">
                                        </div>

                                        <input type="submit" value="Login" name="login" class="btn btn-primary btn-user btn-block">


                                        <a href="/index.php" class="btn btn-google btn-user btn-block">
                                            Back To Web
                                        </a>
                                        <hr>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
<?php
session_start();
include("koneksi.php"); // Sesuaikan dengan nama file koneksi Anda


// Melakukan query ke database untuk mencocokkan email dan pass
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    $result = $conn->query("SELECT * FROM admin WHERE email='$email' AND pass='$pass'");

    if ($result->num_rows > 0) {
        // Login berhasil
        $_SESSION["email"] = $email;
        header("Location: index.php"); // Sesuaikan dengan halaman setelah login berhasil
        exit();
    } else {
        // Login gagal
        echo "<script>
                 Swal.fire({
                     icon: 'error',
                     title: 'Login Gagal',
                     text: 'Periksa kembali username dan password.',
                     showConfirmButton: false,
                     timer: 2000
                 }).then(function() {
                     window.location.href = 'login.php';
                 });
             </script>";
    }
}
?>