<?php
    include('../backend/connect.php');
    
    $sql = $mysqli->query('CREATE DATABASE bookStore');

    if ($sql) {
        echo 'Create database successfully!<br>';
    } else {
        echo 'Can not create database!<br>';
    }
?>