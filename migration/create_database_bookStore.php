<?php
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');
        
    $sql = $mysqli->query('CREATE DATABASE bookStore');

    if ($sql) {
        echo 'Create database successfully!<br>';
    } else {
        echo 'Can not create database!<br>';
    }
?>