<?php
    $server = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'bookStore';

        $mysqli = new mysqli($server, $user, $password, $db);

        if ($mysqli->connect_errno != 0) {
            echo $mysqli->connect_error;
            exit();
        }
?>