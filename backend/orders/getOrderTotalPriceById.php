<?php 
    include_once('../../config.php');
    include_once(ROOT_PATH . '/connect.php');    
    
    function getOrderTotalPriceById($mysqli, $order_id) {
        $data = [];

        //Sử dụng prepared statement để chống SQL Injection
        $stmt = $mysqli->prepare(
            "SELECT SUM(price * quantity) as 'TotalPrice' 
            FROM orderDetails 
            WHERE order_id = ?"
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