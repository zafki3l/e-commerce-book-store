<?php
    include_once('../../../config.php');
    include_once(ROOT_PATH . '/connect.php');
    include_once(ROOT_PATH . '/backend/orders/findOrder.php');
    include_once(ROOT_PATH . '/backend/orders/getOrderTotalPriceById.php');
    include_once(ROOT_PATH . '/backend/auth/authUser.php');

    isLogin();
    ensureStaffOrAdmin();

    $username = $_SESSION['username'];

    $orderList = getFindOrder($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/bookStore/public/css/staff/orders/orderIndex.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Index Order</title>
</head>
<body>
    <!--Header-->
    <?php include('../../layouts/staff/staffHeader.php'); ?>


<div class="bookmanage">


    <!--Main content-->
    <div class="sidebar">
        <!-- <h2>THIS IS STAFF DASHBOARD</h2> -->
        <div class="name-user">
            <i class="fa-solid fa-circle-user"></i>
            <h3>WELCOME, <?php echo htmlspecialchars($username); ?></h3>
        </div>

        <hr>
        
        <br>

        <div class="function">
            <div class="item-function">
                <i class="fa-solid fa-book"></i>
                <a href="../books/bookIndex.php" class="btn">Book Management</a>
            </div>

            <div class="item-function">
                <i class="fa-solid fa-receipt"></i>
                <a href="../orders/orderIndex.php" class="btn">Order Management</a>
            </div>

            <div class="item-function">
                <i class="fa-solid fa-filter"></i>
                <a href="../createSalesReport.php" class="btn">Create Monthly Sales Report</a>
            </div>
        </div>
    </div>
    <!--Main content-->
    <div class="main-content">
        <div class="content-right">
            <div class="content1">
                <h2>ORDER MANAGEMENT</h2>
            </div>

            <div class="content2">
                <form action="orderIndex.php" method="post">
                    <input type="text" name="search" id="book" placeholder="Find order by order id">
                    <input type="submit" id="submit">
                </form>
                <br>
                <!-- <a href="addOrder.php">Create Order</a> -->
            </div>

            <div class="table">
                <table border="1">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User ID</th>
                            <th>User Name</th>
                            <th>Address</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Created at</th>
                            <th>Updated at</th>
                            <th style="width: 18%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php foreach ($orderList as $order): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($order['id']) ?></td>
                                    <td><?php echo htmlspecialchars($order['user_id']) ?></td>
                                    <td><?php echo htmlspecialchars($order['username']) ?></td>
                                    <td><?php echo htmlspecialchars($order['address']) ?></td>
                                    <td><?php echo htmlspecialchars(getOrderTotalPriceById($mysqli, $order['id'])) ?></td>
                                    <td>
                                        <?php 
                                            switch($order['status']) {
                                                case 1: $statusName = 'Pending'; break;
                                                case 2: $statusName = 'Being delivered'; break;
                                                case 3: $statusName = 'Completed'; break;
                                                default: echo htmlspecialchars('Unknown');
                                            }
                                            echo htmlspecialchars($statusName);
                                        ?>
                                    </td>
                                    <td><?php echo htmlspecialchars($order['created_at']) ?></td>
                                    <td><?php echo htmlspecialchars($order['update_at']) ?></td>
                                    <td>
                                        <!-- <a href="viewOrderDetail.php?id=<?php echo htmlspecialchars($order['id']) ?>" class="btn2">
                                            <i class="fa-solid fa-info"></i>
                                        </a> -->
                                        <button class="btn-detail" data-id="<?php echo htmlspecialchars($order['id']); ?>">
                                            <i class="fa-solid fa-info"></i>
                                        </button>
        
                                        <a href="editOrder.php?id=<?php echo htmlspecialchars($order['id']) ?>" class="btn-edit btn2">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form class="action" action="../../../backend/orders/deleteOrder.php" method="post" style="display:inline;">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($order['id']); ?>">
                                            <input type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
                                            <button type="submit" class="btn-delete btn2">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="box">

            </div> 
        </div>
        <!-- <div class="box">

        </div>                                -->

    </div>
</div>
</body>

<script>
window.onload = () => {
    const buttonsDetail = document.querySelectorAll('.btn-detail');
    const box = document.querySelector('.box');

    buttonsDetail.forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();
            const orderId = button.dataset.id;
            console.log("Click detail button:", orderId);

            try {
                const res = await fetch(`../orders/getOrderDetailApi.php?id=${orderId}`);
                const data = await res.json();
                console.log("API response:", data);

                if (data.error) {
                    box.innerHTML = `<p style="color:red;">${data.error}</p>`;
                    return;
                }

                box.innerHTML = `
                <div class="box-detail">    
                    <div class="title-box-detail">
                        <h2>Chi tiết đơn hàng #${orderId}</h2>
                    </div>
                    <div class="list-item">
                        ${data.items.map(item => `
                            <div class="item">
                                <p>Book Name: ${item.bookName}</p>
                            </div>
                            <div class="item">
                                <p>Book Author: ${item.author}</p>
                            </div>
                            <div class="item">
                                <p>Book Publisher: ${item.publisher}</p>
                            </div>
                            <div class="item">
                                <p>Price: ${item.price}</p>
                            </div>
                            <div class="item">
                                <p>Quantity: ${item.quantity}</p>
                            </div>
                            <div class="item">
                                <p><b>Total Price: ${item.price * item.quantity} VND</b></p>
                            </div>
                        `).join('')}
                    </div>
                    <div class="btn-cancel">
                        <button class="btn-cancel-detail">Cancel</button>
                    </div>
                </div>
                `;

                // gắn lại sự kiện Cancel
                document.querySelector('.btn-cancel-detail').addEventListener('click', () => {
                    box.innerHTML = "";
                });

            } catch (err) {
                console.error("Fetch error:", err);
                box.innerHTML = "<p style='color:red;'>Không tải được chi tiết đơn hàng.</p>";
            }
        });
    });
};

</script>

</html>