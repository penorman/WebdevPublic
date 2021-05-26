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
        require_once 'dbh.inc.php';

        if(isset($_POST['submit'])){
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            if($_POST['resourceType'] === "studentResource") {
                $path = "../files/studentresources/".$fileName;
            }
            else if ($_POST['resourceType'] === "quiz") {
                $path = "../files/quiz/".$fileName;

            }
            else {
                $path = "../files/".$fileName;
            }
            
            $query = "INSERT INTO filedownload(filename) VALUES('$fileName')";
            $run = mysqli_query($conn, $query);

            if($run) {
                move_uploaded_file($fileTmpName, $path);
            }
        }
    ?>
    <div class="containerAbout">
        <form action="resourcesTutor.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file">
            <select class="resourceType" name="resourceType" id="resourceType">
                <option value = "studentResource">Student Resource</option>
                <option value = "quiz">Quiz</option>                
            </select><br>
            <button type="submit" name="submit">Upload</button>
            
        </form>
    </div>
</body>
</html>