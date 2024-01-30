<?php
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];

    // Query the database to retrieve user information
    $sql = "SELECT username, email, no_telpon FROM pembeli WHERE user_id = '$id'";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
        $email = $row['email'];
        $no_telpon = $row['no_telpon'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Profile</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="index.php">Honey</a></p>
        </div>
        <div class="right-links">
            <a href="editprofile.php">Change Profile</a>
            <a href="logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>
    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Hallo <b>user</b>, Selamat datang</p>
                </div> 
                <div class="box">
                    <p>Email anda adalah <b>user@gmail.com</b>, Selamat datang</p>
                </div> 
            </div>
            <div class="bottom">
                <div class="box">
                    <p>No Telpon anda  <b>12345678910</b>.</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>