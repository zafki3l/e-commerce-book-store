<?php 
    include_once('../../config.php');
    include_once(ROOT_PATH . '/backend/bookSection/onSales.php');

    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Tạo CSRF token nếu chưa có
    if (!isset($_SESSION['token'])) {
        $_SESSION['token'] = bin2hex(random_bytes(32));
    }

    $books = $result;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/homepage/homepage.css">
    <title>Document</title>
</head>
<body>
    <h2>ON SALES</h2>
    <div class="book-grid">
        <?php foreach ($books as $book): ?>
            <div class="book-item">
                <img src="../../public/images/<?php echo htmlspecialchars($book['bookCover']) ?>" alt="<?php echo htmlspecialchars($book['bookName']) ?>">
                <p><?php echo htmlspecialchars($book['author']) ?></p>
                <h3><?php echo htmlspecialchars($book['bookName']) ?></h3>
                <p><?php echo htmlspecialchars($book['price']) ?></p>

                <a href="../homepage/viewDetail.php?id=<?php echo $book['id']; ?>" 
                    class="btn-view-detail">View Detail</a>

                <form action="\bookStore\backend\buyNow.php" method="post">
                    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
                    <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                    <input type="hidden" name="price" value="<?php echo $book['price']; ?>">
                    <input type="hidden" name="quantity" value="1">
                    <button type="submit" class="btn-buy-now">Buy now</button>

                    <!-- Nếu khách hàng chưa đăng nhập -->
                    <?php if(!isset($_SESSION['id'])): ?>
                        <input type="text" name="fullname" placeholder="Username">
                        <input type="text" name="guest_email" placeholder="Email">
                    <?php endif; ?>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>