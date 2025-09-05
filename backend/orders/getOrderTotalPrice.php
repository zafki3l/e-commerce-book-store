<?php 
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');

    //Tính tổng của tất cả orderItem trong order
    function getOrderTotalPrice($mysqli, $order_id) 
    {
        //Sử dụng prepared statement để chống SQL Injection
        $stmt = $mysqli->prepare(
            "SELECT order_id, SUM(price * quantity) as 'TotalPrice'
            FROM orderDetails
            WHERE order_id = ?
            GROUP BY order_id"
        );

        /**
         * - Truyền dữ liệu vào câu truy vấn và thực thi nó
         * - Lấy ra kết quả truy vấn
         * - Chuyển kết quả thành mảng kết hợp (Associative Array)
         */
        $stmt->bind_param('i', $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        return $data['TotalPrice'] ?? 0;
    }
?>