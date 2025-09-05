<?php 
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    
    $sql = $mysqli->query(
        'CREATE TABLE users (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(50) NOT NULL,
            email VARCHAR(50) NOT NULL UNIQUE, 
            password VARCHAR(256) NOT NULL,
            role TINYINT NOT NULL DEFAULT(1), # 1 - user, 2 - staff, 3 - admin
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )'
    );

    if ($sql) {
        echo 'Create table successfully!<br>';
    } else {
        echo 'Can not create table!<br>';
    }
?>