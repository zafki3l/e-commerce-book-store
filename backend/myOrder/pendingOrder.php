<?php
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');

    session_start();
    
    //Lấy id người dùng bằng SESSION
    $user_id = $_SESSION['id'];

    //Sử dụng prepared statement để chống SQL Injection
    //Lấy ra tên sách, giá, số lượng của đơn hàng
    $stmt = $mysqli->prepare(
        "SELECT bookName, od.price, od.quantity, o.status
        FROM orders o
        JOIN orderDetails od ON o.id = od.order_id
        JOIN books b ON b.id = od.book_id
        WHERE o.user_id = ? and o.status = 1"
    );

    /**
     * - Gắn userid của người dùng gán vào câu lệnh truy vấn
     * - Sau khi gắn dữ liệu, sử dụng execute để thực thi câu truy vấn
     * - Lấy ra kết quả truy vấn và chuyển nó thành mảng kết hợp (Associative Array)
    */
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_all(MYSQLI_ASSOC);

    return $data;
?>