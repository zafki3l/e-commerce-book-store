<?php 
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');    
    
    function getFindBook($mysqli)
    {
        $data = [];

        //Nếu như ô tìm kiếm đã được nhập dữ liệu vào thì tìm kiếm
        if (isset($_POST['book'])) {
            //Lưu dữ liệu nhập vào của user vào biến
            $book = $_POST['book'];
            $book_id = $book;
            $bookName = "%$book%";
            $author = "%$book%";
            $publisher = "%$book%";

            //Sử dụng prepared statement để chống SQL Injection
            $stmt = $mysqli->prepare(
            "SELECT * FROM books
            WHERE id = ?
                OR bookName LIKE ?
                OR author LIKE ?
                OR publisher LIKE ?"
            );

            /**
             * - Truyền dữ liệu vào câu truy vấn và thực thi nó
             * - Lấy ra kết quả truy vấn
             * - Chuyển kết quả thành mảng kết hợp (Associative Array)
             */
            $stmt->bind_param('isss', $book_id, $bookName, $author, $publisher);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = $result->fetch_all(MYSQLI_ASSOC);
        } else { //Ngược lại, nếu chưa nhập thì vẫn hiển thị tất cả hàng trong bảng books
            $sql = $mysqli->query("SELECT * FROM books");

            $data = $sql->fetch_all(MYSQLI_ASSOC);
        }

        return $data;
    }
?>