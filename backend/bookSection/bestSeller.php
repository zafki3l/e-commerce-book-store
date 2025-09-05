<?php 
    include_once('../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    
    //Lấy ra các sách giảm giá
    $sql = $mysqli->query(
        "SELECT id, bookName, author, price, bookCover
        FROM books
        ORDER BY id DESC
        LIMIT 10"   
    );

    $result = $sql->fetch_all(MYSQLI_ASSOC);

    return $result;
?>