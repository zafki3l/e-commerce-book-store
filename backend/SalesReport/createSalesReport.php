<?php 
    include(__DIR__ . '/../connect.php');
    
    function monthlyReport($conn) 
    {
        $totalPrice = 0;
        if (empty($_POST['month'])) {
            $month = date('m');

            $sql = "SELECT SUM(od.price * od.quantity) as 'TotalPrice' FROM orders o
            JOIN orderDetails od ON o.id = od.order_id 
            WHERE MONTH(o.created_at) = '$month'";

            $query = mysqli_query($conn, $sql);

            if ($query && mysqli_num_rows($query) > 0) {
                $value = mysqli_fetch_assoc($query);
                $totalPrice = $value['TotalPrice'];
            } else {
                $totalPrice = 0;
            }
        } else {
            $month = $_POST['month'];
    
            $sql = "SELECT SUM(od.price * od.quantity) as 'TotalPrice' FROM orders o
                    JOIN orderDetails od ON o.id = od.order_id 
                    WHERE MONTH(o.created_at) = '$month'";

            $query = mysqli_query($conn, $sql);

            if ($query && mysqli_num_rows($query) > 0) {
                $value = mysqli_fetch_assoc($query);
                $totalPrice = $value['TotalPrice'];
            } else {
                $totalPrice = 0;
            }
        }

        return $totalPrice;
    }
?>