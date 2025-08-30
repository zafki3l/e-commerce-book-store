<?php 
    include('../backend/connect.php');

    $sql = "CREATE TABLE orderDetails (
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        order_id INT UNSIGNED NOT NULL,
        book_id INT UNSIGNED NOT NULL,
        price DECIMAL(12,2) NOT NULL,
        quantity INT DEFAULT(1),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        update_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

        CONSTRAINT FK_01_orderDetails FOREIGN KEY (order_id) REFERENCES orders (id),
        CONSTRAINT FK_02_orderDetails FOREIGN KEY (book_id) REFERENCES books (id)
    )";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo 'Create the table successfully!<br>';
    } else {
        echo 'Cannot create table!<br>';
    }
?>