<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p> <a href="profile.php">Back </a></p>
        </div>
        <div class="right-links">
            <a href="#">Change Profile</a>
            <a href="logout.php"><button class="btn">Log Out</button></a>
        </div>
    </div>
    <div class="container">
        <div class="box form-box">
            <header>Edit Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="username">username</label>
                    <input type="text" name="username" id="username" required>
                </div>
                <div class="field input">
                    <label for="email">email</label>
                    <input type="text" name="email" id="email" required>
                </div>
                <div class="field input">
                    <label for="password">password</label>
                    <input type="text" name="password" id="password" required>
                </div>
                <div class="field input">
                    <input type="submit" class="btn" name="submit" value="update" required>
                </div>
            </form>
        </div>
    </div>
</body>
</html>