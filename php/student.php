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
    <link rel="stylesheet" href="../styles/standard.css">

    
    <title>Ace Training</title>
</head>
<body>
    <header>
        <nav>
            <ul class="nav-links">
                <li><a href="student.php">Home</a></li>
                <li><a href="../html/about.html">About</a></li>
                <li><a href="../html/resources.html">Resources</a></li>
                <li><a href="../html/assignments.html">Assignments</a></li>
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