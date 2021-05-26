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

    <!-- Select2 -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../scripts/scripts.js"></script>

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
                <select class="dataList" name="course">
                    <option name="course" value="Law">Law</option>
                    <option name="course" value="Computer Science">Computer Science</option>
                    <option name="course" value="Business Studies">Business Studies</option>
                    <option name="course" value="Sports & Exercise Science">Sports & Exercise Science</option>
                    <option name="course" value="Medicine">Medicine</option>
                    <option name="course" value="Economics">Economics</option>
                    <option name="course" value="Architecture">Architecture</option>
                    <option name="course" value="Accounting & Finance">Accounting & Finance</option>
                    <option name="course" value="Biology">Biology</option>
                    <option name="course" value="History">History</option>
                </select>
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
                <select class="userType" name="userType" id="userType">
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