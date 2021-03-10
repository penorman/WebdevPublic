<?php
    session_start();

    if (!isset($_SESSION["userEmail"]) OR $_SESSION["userType"] != "tutor") {
        echo ("You are not authorised!");
        exit();
    }
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
    <?php
        if (isset($_SESSION["userEmail"])) {
            echo "<h1>Welcome " . $_SESSION["userFirstName"] . " " . $_SESSION["userLastName"] . " You are a " . $_SESSION["userType"] . "</h1>";
        }
    ?>
</body>
</html>