<?php 
    include_once __DIR__ . '/../connect.php';

    if (isset($_POST['edit'])) {
        //Lưu dữ liệu nhập vào vào biến
        $id = $_POST['id'];
        $bookName = $_POST['bookName'];
        $author = $_POST['author'];
        $publisher = $_POST['publisher'];
        $category = $_POST['category'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $bookCover = $_POST['bookCover'];
        $status = (int) (($quantity > 0) ? "1" : "0"); // 0 - hết hàng, 1 - còn hầng

        //Sử dụng prepared statement để chống SQL Injection
        $stmt = $mysqli->prepare(
                "UPDATE books
                SET bookName = ?,
                    author = ?,
                    publisher = ?,
                    category = ?,
                    description = ?,
                    price = ?,
                    quantity = ?,
                    status = ?,
                    bookCover = ?
                WHERE id = ?"
            );

        //Nếu như đã upload file
        if (!empty($_FILES['bookCover']['name'])) {
            /**
             * - Lấy tên file gốc mà người dùng nhập từ form html
             * - Tách tên file theo dấu . (Ví dụ: 'myimg.png' => ['myimg', 'png'])
             * - Tạo tên file mới để tránh trùng lặp
             * - Chuyển file đến đường dẫn C:/xampp/htdocs/bookStore/public/images/
             */
            $image_name = $_FILES['bookCover']['name'];

            $tmp = explode(".", $image_name);

            //Kiểm tra nếu người dùng nhập lên một file có đuôi file lạ
            if (end($tmp) != 'png' && end($tmp) && 'jpg' && end($tmp) != 'jpeg') {
                die('File type not allowed');
            }

            $newFileName = round(microtime(true)) . '.' . end($tmp);

            $uploadPath = "C:/xampp/htdocs/bookStore/public/images/" . $newFileName;

            move_uploaded_file($_FILES['bookCover']['tmp_name'], $uploadPath);

            //Truyền dữ liệu nhập vào vào câu truy vấn
            $stmt->bind_param('sssssdiisi', $bookName, $author, $publisher, $category, $description, $price, $quantity, $status, $newFileName, $id);
        } else { //Nếu chưa upload thì gán bookCover bằng giá trị cũ
            //Sử dụng prepared statement để lấy ra giá trị cũ của bookCover
            $query = $mysqli->prepare(
                "SELECT bookCover FROM books
                WHERE id = ?"
            );

            /**
             * - Truyền id nhập vào vào câu truy vấn 
             * - Thực thi truy vấn
             * - Sử dụng get_result() để lấy ra kết quả
             * - Chuyển thành mảng kết hợp (Associative Array)
             */
            $query->bind_param('i', $id);
            $query->execute();
            $result = $query->get_result();
            $data = $result->fetch_assoc();

            // Giữ ảnh bìa của sách nếu như ko upload
            $bookCover = $data['bookCover'];

            //Truyền dữ liệu nhập vào vào câu truy vấn
            $stmt->bind_param('sssssdiisi', $bookName, $author, $publisher, $category, $description, $price, $quantity, $status, $bookCover, $id);
        }

        //Thực thi truy vấn thành công thì chuyển về trang bookIndex
        if ($stmt->execute()) {
            header('Location: ../../view/staff/books/bookIndex.php');
            exit();
        }
    }
?>