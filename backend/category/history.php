<?php 
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    
    //Lấy ra các sách thuộc category history
    $sql = $mysqli->query(
        "SELECT id, bookName, author, price, bookCover
        FROM books
        WHERE category = 'History'"   
    );

    $result = $sql->fetch_all(MYSQLI_ASSOC);

    return $result;
?>