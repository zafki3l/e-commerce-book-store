<?php 
    include('../connect.php');
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT password FROM users
            WHERE email = '$email'";

    $query = mysqli_query($conn, $sql);

    if (!(mysqli_num_rows($query) > 0)) {
        echo 'User not exist!';
    } else {
        $user = mysqli_fetch_assoc($query);
        if (hash('sha256', $password) == $user['password']) {
            header('Location: ../../view/homepage/homepage.php');
            exit();
        } else {
            header('Location: view/auth/login.php');
            exit();
        }
    } 
?>