<?php
session_start(); // Mulai sesi

include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = mysqli_query($koneksi, "select * from pembeli where username='$username' and password='$password'");
    if (mysqli_num_rows($query) > 0) {
        header("Location: index.php");
        exit(); // Pastikan untuk mengakhiri skrip setelah mengalihkan
    } else {
        header("Location: login.php");
        exit(); // Pastikan untuk mengakhiri skrip setelah mengalihkan
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Head section -->
    <title>Login</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="container">
        <div class="box form-box">
            <header>Login</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <div class="field input">
                    <input type="submit" class="btn" name="login" value="Login">
                </div>
                <div class="links">
                    Don't have an account? <a href="register.php">Sign up now</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>