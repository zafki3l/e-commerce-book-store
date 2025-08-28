<?php 
    include('../connect.php');
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);
    $role = $_POST['role'];

    $sql = "INSERT INTO users(username, email, password, role)
            VALUES ('$username', '$email', '$password', '$role')";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: ../../view/admin/dashboard.php');
        exit();
    }
?>