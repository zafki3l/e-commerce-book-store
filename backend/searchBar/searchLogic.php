<?php
include_once __DIR__ . '/../connect.php';

$search = $_GET['search'] ?? '';
$data = [];

if ($search !== '') {
    $likeSearch = "%$search%";
    $stmt = $mysqli->prepare(
        "SELECT bookName, author, price, bookCover
         FROM books
         WHERE bookName LIKE ? OR author LIKE ?"
    );
    $stmt->bind_param('ss', $likeSearch, $likeSearch);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);
}

return ['data' => $data, 'search' => $search];
