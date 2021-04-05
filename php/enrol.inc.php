<?php

    if (isset($_POST["submit"])) {
        
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $course = $_POST["course"];
        $password = $_POST["password"];
        $repeatPassword = $_POST["repeatPassword"];
        $userType = $_POST["userType"];

        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';

        if (emailExists($conn, $email) !== false) {
            header("location: enrol.php?error=emailtaken");
            exit();
        }
        if (pwdMatch($password, $repeatPassword) !== false) {
            header("location: enrol.php?error=passwordsdontmatch");
            exit();
        }

        createUser($conn, $firstName, $lastName, $email, $course, $password, $userType);

    }
    else {
        header("location: enrol.php");
        exit();
    }

?>