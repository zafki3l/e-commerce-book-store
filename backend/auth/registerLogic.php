<?php 
    include('../connect.php');
    
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = hash('sha256', $_POST['password']);

    $sql = "INSERT INTO users (username, email, password)
            VALUES ('$username', '$email', '$password')";

    $query = mysqli_query($conn, $sql);

    if ($query) {
        header('Location: ../../view/auth/login.php');
        exit();
    } else {
        header('Location: ../../view/auth/register.php');
        exit();
    }
?>