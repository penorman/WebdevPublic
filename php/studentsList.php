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
    <script>
        $(document).on("click", ".show-alert", function(e) {
            bootbox.alert("Hello world!", function() {
                console.log("Alert Callback");
            });
        });
    </script>


    <title>Ace Training</title>
</head>
<body>
    <header>
        <nav>
            <ul class="nav-links">
                <li><a href="tutor.php">Home</a></li>
                <li><a href="resourcesTutor.php">Resources</a></li>
                <li><a href="assignmentsTutor.php">Assignments</a></li>
                <li><a href="studentsList.php">Students</a></li>
            </ul>
        </nav>
    </header>

    <table class="table table-striped" id="studentsList">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col">Course</th>
            </tr>
        </thead>
        <tbody>
        <?php

            require_once 'dbh.inc.php';

            $sql = "SELECT id, firstName, lastName, email, course FROM students";
            $result = $conn-> query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr onclick='getScores(". $row["id"]. ")'><td>". $row["id"] . "</td><td>". $row["firstName"] . "</td><td>". $row["lastName"] . "</td><td>". $row["email"] . "</td><td>". $row["course"] . "</td></tr>";
                }
                echo "</table>";
            }

        ?>
        </tbody>
    </table>
</body>
</html>