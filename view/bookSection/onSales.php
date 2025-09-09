<?php 
    include_once('../../config.php');
    include_once(ROOT_PATH . '/backend/bookSection/onSales.php');

    $books = $result;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/homepage/homepage.css">
    <link rel="stylesheet" href="../../public/css/homepage/bookSection.css">
    <title>ON SALES</title>
</head>
<body>
    <h2 class="section">ON SALES</h2>

    <div class="book-grid">
        <?php foreach ($books as $book): ?>
            <div class="book-item">
                <a href="../homepage/viewDetail.php?id=<?php echo $book['id']; ?>">  
                    <img src="../../public/images/<?php echo htmlspecialchars($book['bookCover']) ?>" 
                    alt="<?php echo htmlspecialchars($book['bookName']) ?>">
                </a>
                <h3 class="book-title"><?php echo htmlspecialchars($book['bookName']) ?></h3>
                <p class="book-author"><?php echo htmlspecialchars($book['author']) ?></p>
                <p class="book-price"><?php echo htmlspecialchars($book['discountedPrice']) ?> VND (20% Discounted)</p>

                <!-- Nếu khách hàng đã đăng nhập -->
                <?php if(isset($_SESSION['id'])): ?>
                    <form action="/bookStore/backend/buyNow.php" method="post">
                        <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                        <input type="hidden" name="price" value="<?php echo $book['discountedPrice']; ?>">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="btn-buy-now">Buy now</button>
                    </form>
                <?php else: ?>
                    <!-- Nếu khách hàng chưa đăng nhập -->
                    <!-- Thêm data-book-id và data-price để JS lấy thông tin -->
                    <button type="button"
                            class="btn-buy-guest btn-buy-now"
                            data-book-id="<?php echo $book['id']; ?>"
                            data-price="<?php echo htmlspecialchars($book['discountedPrice']); ?>">
                        Buy now
                    </button>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- === Modal duy nhất (đặt ngoài loop) === -->
    <div class="modal-container" id="guest-modal">
        <div class="modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
            <h2 id="modal-title">Enter Information to Purchase</h2>
            <br>
            <form id="guest-form" action="/bookStore/backend/buyNow.php" method="post">
                <input type="hidden" name="book_id" id="modal-book-id" value="">
                <input type="hidden" name="price" id="modal-book-price" value="">
                
                <label for="fullname">Username</label>
                <input id="fullname" type="text" name="fullname" placeholder="Username" required>

                <label for="guest_email">Email</label>
                <input id="guest_email" type="email" name="guest_email" placeholder="Email" required>

                <div class="modal-actions">
                    <button type="submit" class="btn-confirm">Continue</button>
                    <button type="button" id="modal-cancel" class="btn-cancel">Cancel</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const guestButtons = document.querySelectorAll('.btn-buy-guest');
        const modal = document.getElementById('guest-modal');
        const modalCancel = document.getElementById('modal-cancel');
        const modalBookId = document.getElementById('modal-book-id');
        const modalBookPrice = document.getElementById('modal-book-price');

        guestButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                modalBookId.value = btn.dataset.bookId;
                modalBookPrice.value = btn.dataset.price;
                modal.classList.add('show');
                document.getElementById('fullname').focus();
            });
        });

        modalCancel.addEventListener('click', () => modal.classList.remove('show'));
        modal.addEventListener('click', (e) => {
            if (e.target === modal) modal.classList.remove('show');
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') modal.classList.remove('show');
        });
    });


    // Đóng khi click vào overlay ngoài modal
    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.classList.remove('show');
    });

    // Đóng bằng phím ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') modal.classList.remove('show');
    });
</script>
