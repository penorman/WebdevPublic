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

    <!-- JavaScript -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
    <script src="../scripts/scripts.js"></script>
    
    <title>Ace Training</title>
</head>
<body onload="populateLevelQuiz('<?php echo $_SESSION['userLevel'];?>')">
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

    <div class="quizDiv">
        <form class="quizMenu">
            <select name="quizSelect" id="quizSelect">            
            </select>
            <button type="button" name="loadbutton" onclick="updateForm(<?php echo $_SESSION['userId'];?>)">Load</button>
            <p id="demo"></p>
        </form>

        <form class="quizForm" id="quizForm">
        </form>
    </div>
</body>