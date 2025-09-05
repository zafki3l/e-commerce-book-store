<?php
    include_once('../../config.php');
    include_once(ROOT_PATH . '/connect.php');

    //Lấy ra dữ liệu tìm kiếm của users
    $search = $_GET['search'] ?? '';
    $data = [];

    //Nếu người dùng nhập vào ô tìm kiếm
    if (!empty($search)) {
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
?>