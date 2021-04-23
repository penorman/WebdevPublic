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
                <li><a href="resourcesStudent.php">Resources</a></li>
                <li><a href="../html/assignments.html">Assignments</a></li>
            </ul>
        </nav>
    </header>
    <table>
        <tr>
            <td>
                <?php
                    require_once 'dbh.inc.php';

                    $query = "SELECT * FROM filedownload ";
                    $run = mysqli_query($conn, $query);

                    while($rows = mysqli_fetch_assoc($run)){
                        ?>
                    <h3><?php echo $rows['filename'] ?></h3><a href="download.php?file=<?php echo $rows['filename'] ?>">Download</a><br>
                <?php
                    }
                ?>
            </td>
        </tr>
    </table>
</body>
</html>