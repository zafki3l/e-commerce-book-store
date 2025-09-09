<?php 
    include_once('../../config.php');

    $result = include(ROOT_PATH . '/backend/searchBar/searchLogic.php');
    $books = $result['data'];
    $search = $result['search'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/homepage/homepage.css">
    <link rel="stylesheet" href="../../public/css/homepage/searchResult.css">
    <title>Search result for <?php echo htmlspecialchars($search) ?></title>
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
        <h2 class="search">Search result for "<?php echo htmlspecialchars($search) ?>"</h2>

        <div class="book-grid">
            <?php foreach ($books as $book): ?>
                <div class="book-item">
                    <!-- Nút xem chi tiết -->
                    <a href="viewDetail.php?id=<?php echo $book['id']; ?>">  
                        <img src="../../public/images/<?php echo htmlspecialchars($book['bookCover']) ?>" 
                        alt="<?php echo htmlspecialchars($book['bookName']) ?>">
                    </a>
                    <h3 class="book-title"><?php echo htmlspecialchars($book['bookName']) ?></h3>
                    <p class="book-author"><?php echo htmlspecialchars($book['author']) ?></p>
                    <p class="book-price"><?php echo htmlspecialchars($book['price']) ?> VND</p>

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
