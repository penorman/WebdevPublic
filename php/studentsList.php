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
    <table class="table table-striped">
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

            if ($result -> num_rows > 0) {
                while($row = $result-> fetch_assoc()) {
                    echo "<tr><td>". $row["id"] . "</td><td>". $row["firstName"] . "</td><td>". $row["lastName"] . "</td><td>". $row["email"] . "</td><td>". $row["course"] . "</td></tr>";
                }
                echo "</table>";
            }

        ?>
        </tbody>
    </table>
</body>
</html>