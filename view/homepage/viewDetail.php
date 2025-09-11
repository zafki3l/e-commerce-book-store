<?php 
    include_once(__DIR__ . '/../../config.php');    
    include_once(ROOT_PATH . '/backend/viewDetail.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($book['bookName']); ?></title>
    <link rel="stylesheet" href="../../public/css/homepage/homepage.css">
    <link rel="stylesheet" href="../../public/css/homepage/viewDetail.css">
</head>
<body>
    <!--Header-->
    <?php include('../layouts/header.php') ?>
    <div class="header">
        <ul type="none" class="user-menu">
            <div class="search-bar">
                <form action="\bookStore\view\homepage\searchResult.php" method="get">
                    <input type="text" name="search" placeholder="Search books..."/>
                </form> 
            </div>
        </ul>
    </div>

    <div class="main-content">
        <?php if ($book): ?>
            <div class="infor-book">
                <div class="img-book">
                    <img src="../../public/images/<?php echo htmlspecialchars($book['bookCover']); ?>" 
                        alt="<?php echo htmlspecialchars($book['bookName']); ?>">
                </div>
                <div class="text-infor">
                    <div class="name-book">
                        <h1><?php echo htmlspecialchars($book['bookName']); ?></h1>
                    </div>
                    <div class="content-infor">
                        <div class="brand-book">
                            <p><strong>Author:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                        </div>
                        <div class="content-summary">
                            <p><strong>Description:</strong> <?php echo htmlspecialchars($book['description']); ?></p>
                        </div>

                        <div class="buy-now">
                            <div class="price-book">
                                <h1><?php echo htmlspecialchars($book['price']); ?> VND</h1>
                            </div>
                            <div class="btn-order">
                                <!-- Nếu khách hàng đã đăng nhập -->
                                <?php if(isset($_SESSION['id'])): ?>
                                    <form action="/bookStore/backend/buyNow.php" method="post">
                                        <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                                        <input type="hidden" name="price" value="<?php echo $book['price']; ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn-buy-now">Buy now</button>
                                    </form>
                                <?php else: ?>
                                    <!-- Nếu khách hàng chưa đăng nhập -->
                                    <!-- Thêm data-book-id và data-price để JS lấy thông tin -->
                                    <button type="button"
                                            class="btn-buy-guest btn-buy-now"
                                            data-book-id="<?php echo $book['id']; ?>"
                                            data-price="<?php echo htmlspecialchars($book['price']); ?>">
                                        Buy now
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>     
        <?php else: ?>
            <p>Book not found!</p>
        <?php endif; ?>

        <!-- Modal -->
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
                
                <label for="guest_address">Address</label>
                <input id="guest_address" type="text" name="guest_address" placeholder="Enter your address" required>

                <div class="modal-actions">
                    <button type="submit" class="btn-confirm">Continue</button>
                    <button type="button" id="modal-cancel" class="btn-cancel">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!--Footer-->
    <?php include('../layouts/footer.php') ?>
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
