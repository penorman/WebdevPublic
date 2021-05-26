<?php
    //Database connection
    $serverName = '127.0.0.1';
    $dBUsername = 'root';
    $dBPassword = '';
    $dBName = 'acetraining';

    $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>