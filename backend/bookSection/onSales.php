<?php 
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');

    // Lấy ra các sách đang giảm giá
    $sql = $mysqli->query(
        "SELECT id, bookName, author, price, (price * 0.8) as 'discountedPrice', bookCover
        FROM books
        ORDER BY RAND()
        LIMIT 10"
    );

    $result = $sql->fetch_all(MYSQLI_ASSOC);

    return $result;
?>