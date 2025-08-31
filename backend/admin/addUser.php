<?php 
    include('../connect.php');
    $username = (string) $_POST['username'];
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = hash('sha256', $_POST['password']);
    $role = (int) $_POST['role'];

    $sql = "INSERT INTO users(username, email, password, role)
            VALUES ('$username', '$email', '$password', '$role')";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: ../../view/admin/dashboard.php');
        exit();
    }
?>