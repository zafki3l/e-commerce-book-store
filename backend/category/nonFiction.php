<?php 
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    
    //Lấy ra các sách thuộc category non-fiction
    $sql = $mysqli->query(
        "SELECT id, bookName, author, price, bookCover
        FROM books
        WHERE category = 'Non-Fiction'"   
    );

    $result = $sql->fetch_all(MYSQLI_ASSOC);

    return $result;
?>