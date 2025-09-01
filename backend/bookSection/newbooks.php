<?php 
    include_once __DIR__ . '/../connect.php';
    
    $sql = $mysqli->query(
        "SELECT id, bookName, author, price, bookCover
        FROM books
        ORDER BY id DESC
        LIMIT 10"
    );

    $result = $sql->fetch_all(MYSQLI_ASSOC);

    return $result;
?>