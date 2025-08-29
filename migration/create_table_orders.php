<?php 
    include('../backend/connect.php');

    $sql = "CREATE TABLE orders (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT UNSIGNED NOT NULL,
        book_id INT UNSIGNED NOT NULL,
        quantity INT NOT NULL,
        price DECIMAL(12,2) NOT NULL,
        status TINYINT DEFAULT(1), # 1: pending, 2: being delivered, 3: completed
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

        CONSTRAINT FK_01_orders FOREIGN KEY (user_id) REFERENCES users (id),
        CONSTRAINT FK_02_orders FOREIGN KEY (book_id) REFERENCES books (id)
    )";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo 'Create the table successfully!<br>';
    } else {
        echo 'Cannot create table!<br>';
    }
?>