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
                <li><a href="assignmentstutor.php">Assignments</a></li>
                <li><a href="studentsList.php">Students</a></li>
            </ul>
        </nav>
    </header>

    <?php
        require_once 'dbh.inc.php';

        if(isset($_POST['submit'])){
            $fileName = $_FILES['file']['name'];
            $fileTmpName = $_FILES['file']['tmp_name'];
            $resourceType = $_POST['resourceType'];
            $path;
            $C = false;
            $I = false;
            $H = false;

            if (isset($_POST['levelC'])){
                $C = true;
            }
            if (isset($_POST['levelI'])){
                $I = true;
            }
            if (isset($_POST['levelH'])){
                $H = true;
            }
            $tempJson = json_encode(array('C' => $C, 'I' => $I, 'H' => $H));
            
            if($resourceType === "studentResource") {
                $path = "../files/studentresources/".$fileName;
            }
            else if ($resourceType === "quizText") {
                $path = "../files/quiz/".$fileName;

            }
            else {
                $path = "../files/".$fileName;
            }

            $sql = "INSERT INTO tblresource(resourcePath, resourceName, resourceType, visibleToLevelTypes) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: resources.php?error=stmtfailed");
                exit();
            }   
        
            mysqli_stmt_bind_param($stmt, "ssss", $path, $fileName, $_POST['resourceType'], $tempJson);
            $run = mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // $run = mysqli_query($conn, $sql);

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
                <option value = "quizText">Quiz</option>                
            </select><br>
            <label for="checkC">C</label>
            <input type="checkbox" name="levelC" id="checkC" value=true>
            <label for="checkI">I</label>
            <input type="checkbox" name="levelI" id="checkI" value=true>
            <label for="checkC">H</label>
            <input type="checkbox" name="levelH" id="checkH" value=true>
            <br/>
            
            <button type="submit" name="submit">Upload</button>
            
        </form>
    </div>
</body>
</html>