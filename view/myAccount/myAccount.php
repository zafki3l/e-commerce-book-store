<?php 
include_once('../../config.php');
include_once(ROOT_PATH . '/backend/auth/authUser.php');

isLogin();
$username = $_SESSION['username'] ?? ''; 
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
                
            </div>
          </div>
        </div>

        <!-- list-product -->
        <div class="list-product">

        </div>
      </div>
    </div>
  </div>

  <script>
  async function loadOrders() {
      try {
          const res = await fetch("getOrdersApi.php");
          const orders = await res.json();

          console.log("Orders:", orders);

          const list = document.querySelector(".list-product");
          list.innerHTML = "";

          orders.forEach(order => {
              let coversHTML = "";
              if (order.bookCovers && Array.isArray(order.bookCovers)) {
                  coversHTML = order.bookCovers.map(src => `
                      <div class="img-book">
                          <img src="${src}" alt="Book cover">
                      </div>
                  `).join('');
              }

              list.innerHTML += `
                  <div class="item-list-product">
                      <div class="status-product">
                          <div class="id-status-product">
                              <div class="id-product">
                                  <p>#${order.orderId}</p>
                              </div>
                              <div class="infor-status">
                                  <p>${order.statusText}</p>
                              </div>
                          </div>
                          <div class="date-product">
                              <p>${order.created_at}</p>
                          </div>
                      </div>

                      <div class="img-nameBook">
                          ${coversHTML}
                          <div class="nameBook">
                              <p>${order.bookNames}</p>
                          </div>
                      </div>

                      <div class="payment-information">
                          <div class="product-quantity">
                              <p>${order.totalQuantity} sản phẩm</p>
                          </div>

                          <div class="price-product">
                              <div style="display:flex;flex-direction:row-reverse;margin-bottom:12px;">
                                  <p style="color:#919191">
                                      Tổng tiền: <span style="font-weight:600;color:black">${order.totalPrice}đ</span>
                                  </p>
                              </div>
                              <div class="btn">
                                  <button class="btn-evaluate">Đánh giá đơn hàng</button>
                                  <button class="btn-buyback">Mua lại</button>
                              </div>
                          </div>
                      </div>
                  </div>
              `;
          });

          const total = orders.length;
          const completed = orders.filter(o => o.statusText === "Completed").length;
          const pending = orders.filter(o => o.statusText === "Pending").length;
          const delivering = orders.filter(o => o.statusText === "Being Delivered").length;

          document.querySelector(".list-infor-my-order").innerHTML = `
              <div class="item-infor-my-order">
                  <p>${total}</p>
                  <p>Tất cả</p>
              </div>
              <div class="item-infor-my-order">
                  <p>${completed}</p>
                  <p>Hoàn tất</p>
              </div>
              <div class="item-infor-my-order">
                  <p>${pending}</p>
                  <p>Chưa hoàn thành</p>
              </div>
              <div class="item-infor-my-order">
                  <p>${delivering}</p>
                  <p>Đang giao</p>
              </div>
          `;
      } catch (err) {
          console.error("Error loading orders:", err);
      }
  }

  document.addEventListener("DOMContentLoaded", loadOrders);
  </script>
</body>
</html>
