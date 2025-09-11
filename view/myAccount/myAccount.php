<?php 
include_once('../../config.php');
include_once(ROOT_PATH . '/connect.php');
include_once(ROOT_PATH . '/backend/auth/authUser.php');
include_once(ROOT_PATH . '/backend/myOrder/getAllOrder.php');
include_once(ROOT_PATH . '/backend/myOrder/pendingOrder.php');
include_once(ROOT_PATH . '/backend/myOrder/beingDeliveredOrder.php');
include_once(ROOT_PATH . '/backend/myOrder/completedOrder.php');

isLogin();
$username = $_SESSION['username'] ?? ''; 
$orders = getAllOrder($mysqli); // Lấy danh sách đơn hàng từ cơ sở dữ liệu
$pendingOrder = getPendingOrder($mysqli);
$beingDeliveredOrder = getBeingDeliveredOrder($mysqli);
$completedOrder = getCompletedOrder($mysqli);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../public/css/myAccount.css">
  <title>My account</title>
</head>
<body>
  <!--Header-->
  <div class="header">
      <?php include('../layouts/header.php') ?>
  </div>

  <!--Main content-->
  <div class="main-content">
    <div class="my-order">
      <div class="content-right">
        <!-- dashbroad-my-order -->
        <div class="dashbroad-my-order-conatiner">
          <div class="dashbroad-my-order">
            <div class="title-dashbroad-my-order">
              <h1>WELCOME <?php echo htmlspecialchars($username) ?></h1>
              <h2>My Order</h2>
            </div>

            <div class="list-infor-my-order">
              <?php 
              $total = count($orders);
              $completed = count($completedOrder);
              $pending = count($pendingOrder);
              $delivering = count($beingDeliveredOrder);
              ?>
              <div class="item-infor-my-order">
                  <p><?php echo $total; ?></p>
                  <p>All orders</p>
              </div>
              <div class="item-infor-my-order">
                  <p><?php echo $completed; ?></p>
                  <p>Completed</p>
              </div>
              <div class="item-infor-my-order">
                  <p><?php echo $pending; ?></p>
                  <p>Pending</p>
              </div>
              <div class="item-infor-my-order">
                  <p><?php echo $delivering; ?></p>
                  <p>Being Delivered</p>
              </div>
            </div>
          </div>
        </div>

        <!-- list-product -->
        <div class="list-product">
          <?php foreach ($orders as $order): ?>
          <div class="item-list-product">
              <div class="status-product">
                  <div class="id-status-product">
                    <div class="id-product">
                          <p>#<?php echo htmlspecialchars($order['id']); ?></p>
                      </div>
                      <div class="infor-status">
                          <p>
                            <?php 
                            switch ($order['status']) {
                                case 1: $statusName = 'Pending'; break;
                                case 2: $statusName = 'Being Delivered'; break;
                                case 3: $statusName = 'Completed'; break;
                                default: $statusName = 'Unknown';
                            }
                            echo htmlspecialchars($statusName); ?></p>
                      </div>
                  </div>
              </div>

              <div class="img-nameBook">
                <div class="img-book">
                    <img src="../../public/images/<?php echo htmlspecialchars($order['bookCover']); ?>" alt="Book cover">
                </div>
                  <div class="nameBook">      
                      <p><?php echo htmlspecialchars($order['bookName']); ?></p>
                  </div>
              </div>

              <div class="payment-information">
                  <div class="product-quantity">
                      <p><?php echo htmlspecialchars($order['quantity']); ?> product</p>
                  </div>

                  <div class="price-product">
                      <div style="display:flex;flex-direction:row-reverse;margin-bottom:12px;">
                          <p style="color:#919191">
                              Total: <span style="font-weight:600;color:black"><?php echo htmlspecialchars($order['price'] * $order['quantity']); ?>đ</span>
                          </p>
                      </div>
                      <div class="btn">
                        <?php if(isset($_SESSION['id'])): ?>
                            <form action="/bookStore/backend/buyNow.php" method="post">
                                <input type="hidden" name="book_id" value="<?php echo $order['book_id']; ?>">
                                <input type="hidden" name="price" value="<?php echo $order['price']; ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="btn-buyback">Buy back</button>
                            </form>
                        <?php endif; ?>
                      </div>
                  </div>
              </div>
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>