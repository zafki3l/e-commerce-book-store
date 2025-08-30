<?php 
    include(__DIR__ . '/../connect.php');
    function getFindOrder($conn)
    {
        $book = $_POST['order'] ?? '';
        $result = [];

        if ($book != '') {
            $sql = "SELECT * FROM orders
            WHERE id = '$book'
                OR user_id = '$book'
                OR status = '$book'";

            $query = mysqli_query($conn, $sql);

            if (!$query) {
                echo "ERROR<br>";
            } else {
                while ($value = mysqli_fetch_assoc($query)) {
                    $result[] = $value;
                }
            }

            return $result;
        } else {
            $sql = "SELECT * FROM orders";

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
    }
?>