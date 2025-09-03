<?php 
    session_start();
    include('connect.php');

    //Lấy thông tin người dùng đã đăng nhập
    $user_id = $_SESSION['id'] ?? 0;
    $book_id = $_POST['book_id'] ?? 0;
    $book_price = $_POST['price'] ?? 0;
    $quantity = $_POST['quantity'] ?? 1;

    if ($book_id) {
        //Nếu như khách hàng đã đăng nhập
        if (!$user_id) {
            //Tạo thông tin khách hàng mới vào bảng users, cho role = 0 (Guest)
            $fullName = $_POST['fullname'];
            $email = $_POST['guest_email'];

            $stmt = $mysqli->prepare(
                "INSERT INTO users (username, email, password, role)
                VALUES (?, ?, 'abc', 0)"
            );

            $stmt->bind_param('ss', $fullName, $email);
            $stmt->execute();
            $user_id = $stmt->insert_id;
        }
        // Tạo đơn hàng
        $stmt = $mysqli->prepare("INSERT INTO orders (user_id) VALUES (?)");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $orderId = $stmt->insert_id;

        // Thêm chi tiết đơn hàng
        $stmt = $mysqli->prepare("INSERT INTO orderDetails (order_id, book_id, price, quantity) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iidi", $orderId, $book_id, $book_price, $quantity);
        $stmt->execute();

        header('Location: ../view/homepage/index.php');
    } else {
        echo "Không thể mua sách. LỖI";
    }
?>