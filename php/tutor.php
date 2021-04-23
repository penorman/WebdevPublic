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
    <link rel="stylesheet" href="../styles/standard.css">

    
    <title>Ace Training</title>
</head>
<body>
    <header>
        <nav>
            <ul class="nav-links">
                <li><a href="tutor.php">Home</a></li>
                <li><a href="resourcesTutor.php">Resources</a></li>
                <li><a href="#">Assignments</a></li>
                <li><a href="studentsList.php">Students</a></li>
            </ul>
        </nav>
    </header>
    <?php
        if (isset($_SESSION["userEmail"])) {
            echo "<h1>Welcome " . $_SESSION["userFirstName"] . " " . $_SESSION["userLastName"] . "</h1>";
            echo "<h2>Your Personal ID: " . $_SESSION["userId"] . "</h2>";
            echo "<h2>Your E-Mail Address: " . $_SESSION["userEmail"] . "</h2>";
            echo "<h2>Your course: " . $_SESSION["userCourse"] . "</h2>";
        }
    ?>
</body>
</html>