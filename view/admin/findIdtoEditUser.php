<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/admin/findIdToEditUser.css">
    <title>Find user id to edit</title>
</head>
<body>
    <!--Header-->
    <?php include('../layouts/admin/adminHeader.php') ?>

    <div class="main-content">
        <form action="editUser.php">
            <input type="text" name="id" placeholder="User id">
            <input type="submit">
            <a href="dashboard.php">cancel</a>
        </form>
    </div>
</body>
</html>

<?php
    include('C:\xampp\htdocs\bookStore\backend\connect.php'); 
    //Hàm findUser để sửa user theo id
    function findUser($mysqli)
    {
        //Lấy id user thông qua form nhập
        $id = $_GET['id']; 

        //Sử dụng prepared statement để chống SQL Injection
        $stmt = $mysqli->prepare(
            "SELECT * FROM users WHERE id = ?"
        );

        /**
         * - Truyền id nhập vào từ form vào câu truy vấn
         * - Thực thi truy vấn
         * - Lấy ra kết quả truy vấn
         * - Chuyển thành mảng kết hợp (Associative Array)
         */
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        return $data;
    }
?>