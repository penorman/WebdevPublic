<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- CSS -->
    <link rel="stylesheet" href="../styles/style.css">

    
    <title>Ace Training</title>
</head>
<body>
    <h1>
        Hello
    </h1>
    <?php
        if (isset($_SESSION["userEmail"])) {
            echo "<h1>Welcome " . $_SESSION["userFirstName"] . " " . $_SESSION["userLastName"] . "</h1>";
        }
    ?>
</body>
</html>