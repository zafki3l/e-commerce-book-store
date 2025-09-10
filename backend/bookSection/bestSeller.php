<?php 
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    
    //Lấy ra các sách best seller
    $sql = $mysqli->query(
        "SELECT b.id, bookName, author, b.price, bookCover, SUM(od.quantity) as total_sold
        FROM books b
        JOIN orderDetails od ON b.id = od.book_id
        GROUP BY id, bookName, author
        ORDER BY total_sold DESC
        LIMIT 10"   
    );

    $result = $sql->fetch_all(MYSQLI_ASSOC);

    return $result;
?>