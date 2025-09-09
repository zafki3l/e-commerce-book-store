<?php
    include_once(__DIR__ . '/../config.php');
    include_once(ROOT_PATH . '/connect.php');

    $id = $_GET['id'];

    $stmt = $mysqli->prepare("SELECT * FROM books WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $book = $result->fetch_assoc();
?>


