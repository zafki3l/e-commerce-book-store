<?php 
    include_once('../../config.php');
    include_once(ROOT_PATH . '/connect.php');

    //Xử lý logic truy vấn orderDetails
    function getOrderDetailList($mysqli, $order_id) 
    {
        //Sử dụng prepared statement để chống SQL Injection
        $stmt = $mysqli->prepare(
            "SELECT od.id, 
                    od.order_id, 
                    od.book_id, 
                    b.bookName, 
                    b.author, 
                    b.publisher,
                    od.price,
                    od.quantity,
                    od.created_at,
                    od.update_at
            FROM orderDetails od
            INNER JOIN orders o ON od.order_id = o.id
            INNER JOIN books b ON od.book_id = b.id 
            WHERE o.id = ?"
        );

        /**
         * - Truyền dữ liệu vào câu truy vấn và thực thi nó
         * - Lấy ra kết quả truy vấn
         * - Chuyển kết quả thành mảng kết hợp (Associative Array)
         */
        $stmt->bind_param('i', $order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);


        return $data;
    }

?>