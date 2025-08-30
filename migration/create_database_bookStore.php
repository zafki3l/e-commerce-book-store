<?php
    include('../backend/connect.php');
    
    $sql = 'CREATE DATABASE bookStore';

    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo 'Create database successfully!<br>';
    } else {
        echo 'Can not create database!<br>';
    }
?>