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
    <link rel="stylesheet" href="../styles/style.css">

    <title>Enrol</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Ace Training</h1>
        </div>
        <form action="enrol.inc.php" method="post">
            <div class="mb-3">
                <label for="FirstName" class="form-label">First Name</label>
                <input type="text" class="form-control" name="firstName" required>
            </div>
            <div class="mb-3">
                <label for="LastName" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lastName" required>
            </div>
            <div class="mb-3">
                <label for="Email" class="form-label">E-Mail Address</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="mb-3">
                <label for="dataList" class="form-label">Course Subject</label>
                <input class="form-control" list="courseList" id="dataList" name="course" placeholder="Type to search...">
                <datalist id="courseList">
                    <option name="course" value="Law">
                    <option name="course" value="Computer Science">
                    <option name="course" value="Business Studies">
                    <option name="course" value="Sports & Exercise Science">
                    <option name="course" value="Medicine">
                    <option name="course" value="Economics">
                    <option name="course" value="Architecture">
                    <option name="course" value="Accounting & Finance">
                    <option name="course" value="Biology">
                    <option name="course" value="History">
                </datalist>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="mb-3">
                <label for="repeatPassword" class="form-label">Repeat Password</label>
                <input type="password" class="form-control" name="repeatPassword" required>
            </div>
            <div class="mb-3">
                <label for="userType" class="form-label">User Type</label>
                <select name="userType" id="userType">
                    <option value="student">Student</option>
                    <option value="tutor">Tutor</option>
                </select>                
            </div>
            <div class="mb-3">
                <button type="submit" name="submit">Enrol</button>
            </div>
        </form>

        <?php
            if (isset($_GET["error"])) {
                if ($_GET["error"] == "passwordsdontmatch") {
                    echo "<p style='color:white; text-align:right;'>Password doesn't match!</p>";
                }
                else if ($_GET["error"] == "emailtaken") {
                    echo "<p style='color:white; text-align:right;'>Provided E-Mail Address has been already taken!</p>";
                }
            }
        ?>
    </div>

    <div class="background-video">
        <video autoplay muted loop src="../styles/assets/video.mp4"></video>
    </div>
</body>
</html>