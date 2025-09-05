<?php 
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');

    $sql = $mysqli->query(
        "CREATE TABLE orders (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_id INT UNSIGNED NULL,
            status TINYINT DEFAULT(1), # 1: pending, 2: being delivered, 3: completed
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

            CONSTRAINT FK_01_orders FOREIGN KEY (user_id) REFERENCES users (id)
                ON UPDATE CASCADE
                ON DELETE CASCADE
        )"
    );

    if ($sql) {
        echo 'Create the table successfully!<br>';
    } else {
        echo 'Cannot create table!<br>';
    }
?>