<?php
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'bookStore';

    $conn = new mysqli($server, $user, $password, $db);

    if (!$conn) {
        echo 'Can not connect to database<br>';
    } else {
        echo 'Connected to database successfully<br>';
    }
?>