<?php 
    include_once(__DIR__ . '/../../config.php');
    include_once(ROOT_PATH . '/connect.php');

    //Lưu dữ liệu nhập vào từ form vào biến
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
        "INSERT INTO books(bookName, author, publisher, category, description, price, quantity, status, bookCover)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)"
    );

    //Nếu như người dùng đã upload file
    if (!empty($_FILES['bookCover']['name'])) {

        /**
         * - Lấy tên file gốc mà người dùng nhập vào từ form
         * - Tách tên file thành 2 nửa theo dấu . (Ví dụ: 'myimg.png' => ['myimg', 'png'])
         * - Tạo tên file mới tránh trùng lặp
         * - Chuyển file đến đường dẫn C:/xampp/htdocs/bookStore/public/images/
         */
        $image_name =  $_FILES['bookCover']['name'];    

        $tmp = explode(".", $image_name);

        //Kiểm tra nếu người dùng nhập file có đuôi file lạ
        if (end($tmp) != 'png' && end($tmp) != 'jpg' && end($tmp) != 'jpeg'
            && end($tmp) != 'PNG' && end($tmp) != 'JPG' && end($tmp) != 'JPEG') {
            die('File type not allowed');
        }
        $newFileName = round(microtime(true)) . '.' . end($tmp);

        $uploadPath = "C:/xampp/htdocs/bookStore/public/images/" . $newFileName;

        move_uploaded_file($_FILES['bookCover']['tmp_name'], $uploadPath);

        $stmt->bind_param('sssssdiis', $bookName, $author, $publisher, $category, $description, $price, $quantity, $status, $newFileName);
    } else { // Nếu chưa upload thì truyền giá trị rỗng vào bookCover
        $bookCover = '';

        $stmt->bind_param('sssssdiis', $bookName, $author, $publisher, $category, $description, $price, $quantity, $status, $bookCover);
    }

    // Nếu câu truy vấn được thực thi thành công thì chuyển hướng về trang bookIndex
    if ($stmt->execute()) {
            header('Location: ../../view/staff/books/bookIndex.php');
            exit();
        }
?>