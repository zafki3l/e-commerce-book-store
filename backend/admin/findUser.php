<?php 
    include(__DIR__ . '/../connect.php');
    function getFindUser($conn)
    {
        $user = $_POST['user'] ?? '';
        $result = [];

        $sql = "SELECT * FROM users
                WHERE id = '$user'
                OR username LIKE '%$user%'";

        $query = mysqli_query($conn, $sql);

        if (!$query) {
            echo "ERROR<br>";
        } else {
            while ($value = mysqli_fetch_assoc($query)) {
                $result[] = $value;
            }
        }

        return $result;
    }
?>