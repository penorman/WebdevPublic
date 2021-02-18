<?php
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $password = $_POST['password'];
    $repeatPassword = $_POST['repeatPassword'];


    //Database Connection
    $conn = new mysqli('localhost', 'root', '', 'acetraining');
    if($conn->connect_error){
        die('Connection failed : '.$conn->connect_error);
    }else {
        $stmt = $conn->prepare("insert into students(firstName, lastName, email, course, password, repeatPassword)
        values(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss",$firstName, $lastName, $email, $course, $password, $repeatPassword);
        $stmt->execute();
        echo "Registration successfull";
        
        $stmt->close();
        $conn->close();
    }
?>