<?php 
    include('../connect.php');
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);
    $role = $_POST['role'];
    $id = $_POST['id'];

    $sql = "UPDATE users 
            SET username = '$username', 
                email = '$email',
                password = '$password',
                role = '$role'
            WHERE id = '$id'";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: ../../view/admin/dashboard.php');
        exit();
    }
?>