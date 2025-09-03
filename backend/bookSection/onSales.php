<?php 
    include_once __DIR__ . '/../connect.php';
    
    //:ấy ra các sách đang giảm giá
    $sql = $mysqli->query(
        "SELECT id, bookName, author, price, (price * 0.8), bookCover
        FROM books
        ORDER BY id DESC
        LIMIT 10"
    );

    $result = $sql->fetch_all(MYSQLI_ASSOC);

    return $result;
?>