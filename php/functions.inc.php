<?php

    //Function to check if email has been already taken
    function emailExists($conn, $email) {
        $sql = "SELECT * FROM students WHERE email = ?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: enrol.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);

        $resultsData = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($resultsData)) {
            return $row;
        }
        else {
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }
    
    //Function to check if passwords match
    function pwdMatch($password, $repeatPassword) {
            $result;

            if ($password !== $repeatPassword) {
                $result = true;
            }
            else {
                $result = false;
            }
            return $result;
        }

    //Function to create user in database
    function createUser($conn, $firstName, $lastName, $email, $course, $password, $userType, $levelType) {
        $sql = "INSERT INTO students (firstName, lastName, email, course, password, userType, levelType) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: enrol.php?error=stmtfailed");
            exit();
        }

        //Password to be hashed in database
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
        
    
        mysqli_stmt_bind_param($stmt, "sssssss", $firstName, $lastName, $email, $course, $hashedPwd, $userType, $levelType);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../html/index.html?error=none");
        echo("$firstName, $lastName, $email, $course, $password, $userType, $levelType");
        exit();
    }

    //Function to let login a student
    function loginUser($conn, $email, $pwd) {
        $emailExists = emailExists($conn, $email);

        if ($emailExists === false) {
            header("location: login.php?error=emaildontexist");
            exit();
        }
        else if ($emailExists !== false) {
            session_start();
            $_SESSION["userEmail"] = $emailExists["email"];
            $_SESSION["userFirstName"] = $emailExists["firstName"];
            $_SESSION["userLastName"] = $emailExists["lastName"];
            $_SESSION["userType"] = $emailExists["userType"];
            $_SESSION["userCourse"] = $emailExists["course"];
            $_SESSION["userId"] = $emailExists["id"];

            if ($_SESSION["userType"] == "student") {
                header("location: student.php");
            }
            if ($_SESSION["userType"] == "tutor") {
                header("location: tutor.php");
            }
            exit();
        }
    }
?>