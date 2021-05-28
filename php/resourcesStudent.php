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
                <li><a href="resourcesStudent.php">Resources</a></li>
                <li><a href="assignmentsStudent.php">Assignments</a></li>
                <li><a href="studentReport.php">Report</a></li>
            </ul>
        </nav>
    </header>
    <table>
        <tr>
            <td>
                <?php
                    require_once 'dbh.inc.php';

                    $query = "SELECT * FROM tblresource WHERE resourceType = 'studentResource' AND studentsVisible = 1";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) == 0) {
                        ?><h3>No Resources Available</h3><br>
                        <?php                            
                    }

                    while($rows = mysqli_fetch_assoc($result)){
                        $visibleLevels = json_decode($rows['visibleToLevelTypes'], true);
                        $userLevel = $_SESSION['userLevel'];
                        if ($visibleLevels[$userLevel] == true){
                        ?><h3><?php echo $rows['resourceName'] ?></h3><a href="download.php?file=<?php echo $rows['resourcePath'] ?>">Download</a><br>
                        <?php
                            }
                        }
                        ?>
                        
                        
            </td>
        </tr>
    </table>
</body>
</html>