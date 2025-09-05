<?php 
    include_once('../../config.php');
    include_once(ROOT_PATH . '/connect.php');    
    
    function getFindOrder($mysqli)
    {
        $data = [];

        //Nếu như nút tìm có người bấm nút tìm kiếm
        if (!empty($_POST['search'])) {
            $search = $_POST['search']; 
            $id = $search;
            $username = "%$search%";
            //Sử dụng prepared statement để chống SQL Injection
            $stmt = $mysqli->prepare(
                "SELECT o.id, o.user_id, u.username, o.status, o.created_at, o.update_at 
                FROM orders o
                INNER JOIN users u ON o.user_id = u.id 
                WHERE o.id = ?
                    OR u.username LIKE ?
                ORDER BY o.id ASC"
            );
        
            /**
             * - Truyền dữ liệu vào câu truy vấn và thực thi nó
             * - Lấy ra kết quả truy vấn
             * - Chuyển kết quả thành mảng kết hợp (Associative Array)
             */
            $stmt->bind_param('is', $id, $username);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
        } else { //Nếu nút tìm kiếm chưa dc bấm thì vẫn hiển thị tất cả kết quả
            $sql = $mysqli->query(
                "SELECT o.id, o.user_id, u.username, o.status, o.created_at, o.update_at 
                FROM orders o
                INNER JOIN users u ON o.user_id = u.id
                ORDER BY o.id ASC"
            );

            $data = $sql->fetch_all(MYSQLI_ASSOC);
        }

        return $data;
    }
?>