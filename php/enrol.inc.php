<?php

    if (isset($_POST["submit"])) {
        
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $course = $_POST["course"];
        $password = $_POST["password"];
        $repeatPassword = $_POST["repeatPassword"];

        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';

        if (emailExists($conn, $email) !== false) {
            header("location: ../html/enrol.html?error=emailtaken");
            exit();
        }
        if (pwdMatch($password, $repeatPassword) !== false) {
            header("location: ../html/enrol.html?error=passwordsdontmatch");
            exit();
        }

        createUser($conn, $firstName, $lastName, $email, $course, $password, $repeatPassword);

    }
    else {
        header("location: ../html/enrol.html");
        exit();
    }

?>