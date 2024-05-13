<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post">
                <h1>Create Account</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registeration</span>
                <input type="text" placeholder="Username" name="username">
                <input type="email" placeholder="Email" name="email">
                <input type="password" placeholder="Password" name="password">
                <button type="submit" name="register">Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="post">
                <h1>Sign In</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>or use your username or email password</span>
                <input type="text" placeholder="Username or Email" name="username_or_email">
                <input type="password" placeholder="Password" name="password">
                <a href="#">Forget Your Password?</a>
                <button type="submit" name="login">Sign In</button>
            </form>
            
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Selamat Datang Lagi Kawan Betah Betah Ya ^_^</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hallo! Teman</h1>
                    <p>Ayo Join Ke Website Kami Untuk Membangun Komunitas Yang Baik ^_^</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>

<?php
include_once("koneksi.php");

// Login
if(isset($_POST['login'])){
    $username_or_email = $_POST['username_or_email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE (username='$username_or_email' OR email='$username_or_email') AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Login berhasil
        session_start();
        $_SESSION['username_or_email'] = $username_or_email;
        header("Location: ../userlogin.php"); // Redirect ke halaman dashboard
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

// Register
if(isset($_POST['register'])){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk memeriksa apakah email sudah terdaftar
    $check_email_query = "SELECT * FROM users WHERE email='$email'";
    $check_email_result = $conn->query($check_email_query);

    if ($check_email_result->num_rows > 0) {
        // Email sudah terdaftar
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Email Terdaftar',
            text: 'Email sudah terdaftar. Gunakan email lain atau coba login.',
            showConfirmButton: false,
            timer: 3000
        }).then(function() {
            window.location.href = 'login.php';
        });
        </script>";
    } else {
        // Email belum terdaftar, lakukan pendaftaran
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            // Registrasi berhasil
            echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Register Berhasil',
                text: 'Selamat datang di situs kami!',
                showConfirmButton: false,
                timer: 2000
            }).then(function() {
                window.location.href = 'login.php';
            });
            </script>";
        } else {
            // Error saat melakukan query
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Mendaftar',
                text: 'Terjadi kesalahan saat mendaftar. Silakan coba lagi.',
                showConfirmButton: false,
                timer: 2000
            }).then(function() {
                window.location.href = 'login.php';
            });
            </script>";
        }
    }
}

?>

