<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- jQuery -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>


    <!-- CSS -->
    <link rel="stylesheet" href="../styles/standard.css">


    <!-- JavaScript -->
    <script src="../scripts/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

    <title>Ace Training</title>
</head>
<body>
    <header>
        <nav>
            <ul class="nav-links">
                <li><a href="student.php">Home</a></li>
                <li><a href="resourcesStudent.php">Resources</a></li>
                <li><a href="assignmentsStudent.php">Assignments</a></li>
                <li><a href="studentReport.php">Report</a></li>
            </ul>
        </nav>
    </header>
    <button type="button" name="loadbutton" onclick="getScores(<?php echo $_SESSION['userId'];?>)">Load</button>

</body>
</html>