<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" 
    crossorigin="anonymous">
    
    <!-- CSS -->
    <link rel="stylesheet" href="../styles/style.css">

    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Ace Training</h1>
        </div>
        <form action="../php/login.inc.php" method="post">
            <div class="mb-3">
                <label for="Email" class="form-label">E-Mail Address</label>
                <input class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="mb-3">
                <button type="submit" name="submit">Login</button>
            </div>
        </form>
        <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emaildontexist") {
                    echo "<p style='color:white; text-align:right;'>E-Mail Address doesn't exist!</p>";
                }
            }
        ?>
    </div>
    <div class="background-video">
        <video autoplay muted loop src="../styles/assets/video.mp4"></video>
    </div>
</body>
</html>