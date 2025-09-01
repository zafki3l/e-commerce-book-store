<?php 
    include('../backend/connect.php');

    $sql = $mysqli->query(
        "CREATE TABLE books (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            bookName VARCHAR(100) NOT NULL,
            author VARCHAR(50) NOT NULL,
            publisher VARCHAR(50) NOT NULL,
            category VARCHAR(50),
            description TEXT,
            price DECIMAL(12,2) NOT NULL,
            quantity INT NOT NULL,
            status BOOLEAN DEFAULT(1),
            bookCover VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )"
    );

    if ($sql) {
        echo 'Create table successfully!<br>';
    } else {
        echo 'Can not create table!<br>';
    }
?>